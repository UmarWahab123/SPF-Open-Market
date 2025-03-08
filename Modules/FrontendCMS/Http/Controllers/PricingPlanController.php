<?php

namespace Modules\FrontendCMS\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\FrontendCMS\Services\PricingPlanService;
use Exception;
use Modules\FrontendCMS\Http\Requests\PricingPlanRequest;
use Modules\GST\Entities\GstTax;
use Modules\UserActivityLog\Traits\LogActivity;

class PricingPlanController extends Controller
{
    protected $pricingPlanService;
    public function __construct(PricingPlanService $pricingPlanService)
    {
        $this->middleware('maintenance_mode');
        $this->middleware('prohibited_demo_mode')->only('store');
        $this->pricingPlanService = $pricingPlanService;
    }
    public function index()
    {
        try {
            $gst_taxes = GstTax::where('is_active',1)->get();
            $PricingPlanList = $this->pricingPlanService->getAll();
            return view('frontendcms::pricing-plan.index', compact('PricingPlanList','gst_taxes'));
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
    public function create()
    {
        try {
            $gst_taxes = GstTax::where('is_active',1)->get();
            return response()->json([
                'editHtml' => (string)view('frontendcms::pricing-plan.components.create',compact('gst_taxes'))
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function store(PricingPlanRequest $request)
    {
        try {

            $this->pricingPlanService->save($request->except("_token"));
            LogActivity::successLog('Pricings Status Added');
            return true;
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function edit($id)
    {
        try {
            $gst_taxes = GstTax::where('is_active',1)->get();
            $PricingPlanList = $this->pricingPlanService->editById($id);
            return response()->json([
                'editHtml' => (string)view('frontendcms::pricing-plan.components.edit',compact('gst_taxes')),
                'data' => $PricingPlanList,
            ]);
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(PricingPlanRequest $request)
    {
        try {
            $this->pricingPlanService->update($request->except("_token"));
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
            $this->pricingPlanService->deleteById($request->id);
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
            $this->pricingPlanService->statusUpdate($data, $request->id);
            LogActivity::successLog('Pricings Status Update.');
        } catch (Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
        return $this->loadTableData();
    }

    private function loadTableData()
    {
        try {
            $PricingPlanList = $this->pricingPlanService->getAll();
            return response()->json([
                'TableData' =>  (string)view('frontendcms::pricing-plan.components.list', compact('PricingPlanList'))
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.operation_failed'));
            return back();
        }
    }
}
