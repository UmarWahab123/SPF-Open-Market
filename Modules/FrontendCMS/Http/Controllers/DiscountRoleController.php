<?php

namespace Modules\FrontendCMS\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\FrontendCMS\Services\DiscountRoleService;
use Exception;
use Modules\FrontendCMS\Entities\PricingPlan;
use Modules\FrontendCMS\Http\Requests\DiscountRoleRequest;
use Modules\UserActivityLog\Traits\LogActivity;

class DiscountRoleController extends Controller
{
    protected $discountRoleService;
    public function __construct(DiscountRoleService $discountRoleService)
    {
        $this->middleware('maintenance_mode');
        $this->middleware('prohibited_demo_mode')->only('store');
        $this->discountRoleService = $discountRoleService;
    }
    public function index($id = null)
    {
        try {
            if($id){
             $DiscountRoleList = $this->discountRoleService->getAll($id);
            }else{
             $DiscountRoleList = $this->discountRoleService->getAll();
            }
            $pricingPlan = PricingPlan::where('status',1)->get();
            return view('frontendcms::discount-role.index', compact('DiscountRoleList','pricingPlan'));
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    public function create()
    {
        try {
            $pricingPlan = PricingPlan::where('status',1)->get();
            return response()->json([
                'editHtml' => (string)view('frontendcms::discount-role.components.create',compact('pricingPlan'))
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function store(DiscountRoleRequest $request)
    {
        try {
            $this->discountRoleService->save($request->except("_token"));
            LogActivity::successLog('Discount Status Added');
            return true;
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $pricingPlan = PricingPlan::where('status',1)->get();
            $DiscountRoleList = $this->discountRoleService->editById($id);
            return response()->json([
                'editHtml' => (string)view('frontendcms::discount-role.components.edit',compact('pricingPlan')),
                'data' => $DiscountRoleList,
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(DiscountRoleRequest $request)
    {
        try {
            $this->discountRoleService->update($request->except("_token"));
            LogActivity::successLog('Pricings updated.');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
        return  $this->loadTableData();
    }

    public function destroy(Request $request)
    {
        try {
            $this->discountRoleService->deleteById($request->id);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status'    =>  false,
                'message'   =>  $e->getMessage()
            ]);
        }
        return $this->loadTableData();
    }

    public function status(Request $request)
    {
        try {
            $data = [
                'status' => $request->status == 1 ? 0 : 1
            ];
            $this->discountRoleService->statusUpdate($data, $request->id);
            LogActivity::successLog('Discount Status Update.');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
        return $this->loadTableData();
    }

    private function loadTableData()
    {
        try {
            $DiscountRoleList = $this->discountRoleService->getAll();
            return response()->json([
                'TableData' =>  (string)view('frontendcms::discount-role.components.list', compact('DiscountRoleList'))
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
}
