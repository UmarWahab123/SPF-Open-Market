<?php

namespace Modules\Product\Http\Controllers;

use App\Traits\ImageStore;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\CreateCategoryRequest;
use Modules\Product\Http\Requests\UpdateCategoeryRequest;
use \Modules\Product\Services\CategoryService;
use Modules\Product\Entities\Category;
use Modules\Product\Entities\CategoryImage;
use Modules\Product\Entities\Brand;
use Illuminate\Support\Facades\DB;
use Exception;
use Modules\UserActivityLog\Traits\LogActivity;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use ImageStore;
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('maintenance_mode');
        $this->middleware('prohibited_demo_mode')->only('store');
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        try {
            $data['CategoryList'] = $this->categoryService->getAll();
            return view('product::category.index', $data);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }

    public function getData(){
        $category = $this->categoryService->getData();
        return DataTables::of($category)
            ->addIndexColumn()
            ->editColumn('name', function ($category) {
                return  $category->name;
            })
            ->addColumn('parent_category', function ($category) {
                return $category->parentCategory? $category->parentCategory->name: __("common.parent");
            })
            ->addColumn('commision_rate', function($category){
                return getNumberTranslate($category->commission_rate). '%';
            })
            ->addColumn('status', function ($category) {
                // Render the toggle button for status column
                $checked = $category->status ? 'checked' : '';
                return '
                    <label class="switch_toggle" for="checkbox' . $category->id . '">
                        <input type="checkbox" id="checkbox' . $category->id . '" ' . $checked . ' class="statusChange" 
                               data-value="' . htmlspecialchars(json_encode($category)) . '" value="' . $category->id . '">
                        <div class="slider round"></div>
                    </label>
                ';
            })
            ->addColumn('action', function ($category) {
                return view('product::category.components._action_td', compact('category'));
            })
            ->rawColumns(['parent_category', 'status', 'action'])
            ->toJson();
    }

    public function info()
    {
        try {
            $data['CategoryList'] = $this->categoryService->getAll();
            return view('product::category.index_info', $data);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }

    public function bulk_category_upload_page()
    {
        return view('product::category.bulk_upload');
    }

    public function csv_category_download()
    {
        try {
            $this->categoryService->csvDownloadCategory();
            $filePath = storage_path("app/category_list.xlsx");
        	$headers = ['Content-Type: text/xlsx'];
        	$fileName = time().'-category_list.xlsx';
            return response()->download($filePath, $fileName, $headers);
            return back();
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function bulk_category_store (Request $request)
    {
        $request->validate([
            'file' => ['required','mimes:xls,xlsx,csv,txt','max:2048']
        ]);
        ini_set('max_execution_time', 0);
        DB::beginTransaction();
        try {
            $this->categoryService->csvUploadCategory($request->except("_token"));
            DB::commit();
            LogActivity::successLog('Bulk category store successful.');
            Toastr::success(__('common.uploaded_successfully'),__('common.success'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('common.duplicate_entry_is_exist_in_your_file'));
            }
            else {
                Toastr::error(__('common.Something Went Wrong'));
            }
            LogActivity::errorLog($e->getMessage());
            return back();
        }
    }

    public function list()
    {
        $CategoryList = $this->categoryService->getAll();
        return view('product::category.components.list', compact('CategoryList'));
    }

    public function create()
    {
        try {
            $data['CategoryList']=Category::with(['parentCategory','categoryImage','brands'])->get();
            $data['BrandList']=Brand::get();
            return response()->json([
                'editHtml' => (string)view('product::category.components.create',$data)
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function store(CreateCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->categoryService->save($request->except('_token'));
            DB::commit();
            LogActivity::successLog('Category Added.');
            if(isset($request->form_type)){
                if($request->form_type == 'modal_form'){
                    $first_category = $this->categoryService->firstCategory();
                    return response()->json([
                        'categorySelect' =>  (string)view('product::products.components._category_list_select', compact('first_category')),
                        'categoryParentList' =>  (string)view('product::products.components._category_parent_list', compact('first_category'))
                    ]);
                }else{
                    return  $this->loadTableData();
                }
            }else{
                return  $this->loadTableData();
            }
        } catch (Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e
            ],503);
        }
    }

    public function edit($id)
    {
        try {
            $CategoryList = $this->categoryService->getAll();
            $category = $this->categoryService->editById($id);
            return response()->json([
               'editHtml' => (string)view('product::category.components.edit',compact('CategoryList','category')),
               'status' => true
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e
            ]);
        }
    }

    public function update(UpdateCategoeryRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->categoryService->update($request->except('_token'), $request->id);
            DB::commit();
            LogActivity::successLog('Category Updated.');
            return  $this->loadTableData();
        } catch (Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e
            ]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $parent_id = $this->categoryService->checkParentId($request->id);
            if ($parent_id) {
                return response()->json([
                    'parent_msg' => 'Sorry This id related with another category'
                 ]);
            }
            $result = $this->categoryService->deleteById($request['id']);
            if ($result == "not_possible") {
                return response()->json([
                    'parent_msg' => __('common.related_data_exist_in_multiple_directory')
                ]);
            }
            LogActivity::successLog('category delete successful.');
            return  $this->loadTableData();
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e
            ]);
        }
    }


    private function loadTableData()
    {
        try {
            $CategoryList = $this->categoryService->getAll();
            return response()->json([
                'TableData' =>  (string)view('product::category.components.list'),
                'createForm' =>  (string)view('product::category.components.create', compact(['CategoryList']))
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return response()->json([
                'error' => $e->getMessage()
            ],503);
        }
    }

    public function newCategory(){
        return view('product::new_category.index');
    }

    public function newCategorySetup(){
        return view('product::new_category.components.setup');
    }
    public function status(Request $request)
    {
        try {
            $data = [
                'status' => $request->status == 1 ? 0 : 1
            ];
            $this->categoryService->statusUpdate($data, $request->id);
            LogActivity::successLog('Category Status Update.');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
        return $this->loadTableData();
    }
}
