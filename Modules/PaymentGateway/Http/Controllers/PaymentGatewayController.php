<?php

namespace Modules\PaymentGateway\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\PaymentGateway\Services\PaymentGatewayService;
use Brian2694\Toastr\Facades\Toastr;
use Modules\UserActivityLog\Traits\LogActivity;

class PaymentGatewayController extends Controller
{
    protected $paymentGatewayService;

    public function __construct(PaymentGatewayService  $paymentGatewayService)
    {
        $this->middleware('maintenance_mode');
        $this->paymentGatewayService = $paymentGatewayService;
    }
    public function index()
    {
        if(auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment){
            abort(404);
        }
        $data['gateway_activations'] = $this->paymentGatewayService->seller_payment_gateway();
        $data['gateway_activations'] = $data['gateway_activations']->filter(function ($item) {
            return $item->payment_method_id == 3;
        });
        return view('paymentgateway::index', $data);
    }



    public function configuration(Request $request)
    {
        if(auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment){
            abort(404);
        }
        try {

            $this->paymentGatewayService->update_gateway_credentials($request->except("_token"));
            LogActivity::successLog('payment gateway credential update successful.');
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            return back();
        }catch(\Exception $e){
            dd($e);
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('common.operation_failed'));
            return redirect()->back();
        }
    }
    public function activation(Request $request)
    {
        if(auth()->user()->role->type == 'seller' && !app('general_setting')->seller_wise_payment){
            abort(404);
        }
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $this->paymentGatewayService->update_activation($request->only('id', 'status'));
            $data['gateway_activations'] = $this->paymentGatewayService->seller_payment_gateway();
            LogActivity::successLog('payment activate successful.');
            return response()->json([
                'status' => 1,
                'list' => (string)view('paymentgateway::components._all_config_form_list', $data)
            ]);
        }catch(\Exception $e){
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'status' => 0
            ]);
        }
    }
}
