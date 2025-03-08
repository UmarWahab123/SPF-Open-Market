<?php

namespace Modules\Shipping\Http\Controllers;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Shipping\Http\Requests\CarrierRequest;
use Modules\Shipping\Repositories\CarrierRepository;
use Exception;
use Illuminate\Support\Facades\Http;
use Modules\UserActivityLog\Traits\LogActivity;
use Carbon\Carbon;
class CarrierController extends Controller
{
    protected $carrierRepo;

    public function __construct(CarrierRepository $carrierRepo)
    {
        $this->carrierRepo = $carrierRepo;
    }
    public function index()
    {
        try{
            $data['carriers'] = $this->carrierRepo->all();
            return view('shipping::carriers.new_index',$data);
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json(['error' => $e->getMessage()],503);
        }
    }
    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        try {
            $result = $this->carrierRepo->status($request->except('_token'));
            if($result == 'shipping rate exsist'){
                return response()->json([
                    'status' => 'shipping method exsist'
                ]);
            }else{
                LogActivity::successLog('Carrier activate successful.');
                $data['carriers'] = $this->carrierRepo->all();
                return response()->json([
                    'status' => 1,
                    'list' => (string)view('shipping::carriers.components._config', $data)
                ]);
            }
        }catch(\Exception $e){
            LogActivity::errorLog($e->getMessage());
            return response()->json(['status' => 0]);
        }
    }
    public function configuration(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        try {
            $this->carrierRepo->carrier_credentials($request->except("_token"));
            LogActivity::successLog('Carrier credential update successful.');
            Toastr::success(__('common.updated_successfully'), __('common.success'));
            return back();
        }catch(\Exception $e){
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.error_message'), __('error_message'));
            return redirect()->back();
        }
    }
    
    // public function store(CarrierRequest $request)
    // {
    //     try{
    //         $this->carrierRepo->create($request->except("_token"));
    //         return $this->reloadWithData();
    //     }catch(Exception $e){
    //         Toastr::error($e->getMessage(), 'Error!!');
    //         return response()->json(['error' => $e->getMessage()],503);
    //     }
    // }

    private function reloadWithData($msg_type = null){
        try{
            $data['carriers'] = $this->carrierRepo->all();
            return response()->json([
                'msg_type' => $msg_type,
                'carrier_list' =>  (string)view('shipping::carriers.new_list',$data),
                // 'config' =>  (string)view('shipping::carriers.components._config',$data),
            ],200);
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json([
                'error' => $e->getMessage()
            ],503);
        }
    }

    // private function reloadWithData($msg_type = null){
    //     try{
    //         $data['carriers'] = $this->carrierRepo->all();
    //         return response()->json([
    //             'msg_type' => $msg_type,
    //             'carrier_list' =>  (string)view('shipping::carriers.list',$data),
    //             'config' =>  (string)view('shipping::carriers.components._config',$data),
    //         ],200);
    //     }catch(Exception $e){
    //         Toastr::error($e->getMessage(), 'Error!!');
    //         return response()->json([
    //             'error' => $e->getMessage()
    //         ],503);
    //     }
    // }
    public function edit($id)
    {
        try{
            $row = $this->carrierRepo->find($id);
            // dd($row);
            $msg_type = '';
            if($row->type == 'Automatic'){
                $msg_type = 'Automatic';
            }else{
                $msg_type = 'Manual';
            }
            return response()->json([
                'view' => (string)view('shipping::carriers.new_edit',compact('row')),
                'msg_type' => $msg_type
            ]);
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json(['error' => $e->getMessage()],503);
        }
    }
    // public function edit($id)
    // {
    //     try{
    //         $row = $this->carrierRepo->find($id);
    //         $msg_type = '';
    //         if($row->type == 'Automatic'){
    //             $msg_type = 'Automatic';
    //         }else{
    //             $msg_type = 'Manual';
    //         }
    //         return response()->json([
    //             'view' => (string)view('shipping::carriers.edit',compact('row')),
    //             'msg_type' => $msg_type
    //         ]);
    //     }catch(Exception $e){
    //         Toastr::error($e->getMessage(), 'Error!!');
    //         return response()->json(['error' => $e->getMessage()],503);
    //     }
    // }

    public function store(Request $request)
    {
        $authData = $this->fetchAuthToken($request); // Fetch token using a separate method
    
        if (isset($authData['error'])) {
            return response()->json(['error' => $authData['error']], 503);
        }
    
        try {
            $carrierData = $request->except('_token');
            $expiresAt = Carbon::now()->addSeconds($authData['expires_in']); 
            // Merge token data with the carrier data
            $carrierData = array_merge($carrierData, [
                'access_token' => $authData['access_token'],
                'expires_in'   => $expiresAt->toDateTimeString(),
                'token_type'   => $authData['token_type'],
                'auth_url'   => $request->input('auth_url'),
                'url'   => $request->input('url'),
            ]);
    
            $this->carrierRepo->create($carrierData);
            // return $this->reloadWithData(); // Assuming this redirects or reloads the page with data
    
        } catch (Exception $e) {
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json(['error' => $e->getMessage()], 503);
        }
    }
 

    public function update(CarrierRequest $request,$id)
    {
        $authData = $this->fetchAuthToken($request);
        try{
            $carrierData = $request->except('_token');
            $expiresAt = Carbon::now()->addSeconds($authData['expires_in']); 
            // Merge token data with the carrier data
            $carrierData = array_merge($carrierData, [
                'name'   => $request->input('name'),
                'handling_charges'   => $request->input('handling_charges'),
                'package_type'   => $request->input('package_type'),
                'access_token' => $authData['access_token'],
                'expires_in'   => $expiresAt->toDateTimeString(),
                'token_type'   => $authData['token_type'],
                'audience'   => $request->input('audience'),
                'auth_url'   => $request->input('auth_url'),
                'url'   => $request->input('url'),
            ]);
            $this->carrierRepo->update($carrierData);
            return $this->reloadWithData();
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json(['error' => $e->getMessage()],503);
        }
    }

    private function fetchAuthToken($request)
    {
          // Get the dynamic auth URL from the request input
        $authUrl = rtrim($request->input('auth_url'), '/') . '/oauth/token';

        // Make the POST request to the dynamic auth URL
        $response = Http::asForm()->post($authUrl, [
            'grant_type'    => $request->input('grant_type', 'client_credentials'),  // Default to 'client_credentials' if not provided
            'client_id'     => $request->input('client_id'),
            'client_secret' => $request->input('client_secret'),
            'audience'      => $request->input('audience'),
        ]);

        if ($response->successful()) {
            return $response->json(); // Return token data directly
        }

        // Return error if request fails
        return ['error' => $response->body()];
    }
    // public function update(Request $request,$id)
    // {
    //     try{
    //         $this->carrierRepo->update($request->all(),$id);
    //         return $this->reloadWithData();
    //     }catch(Exception $e){
    //         Toastr::error($e->getMessage(), 'Error!!');
    //         return response()->json(['error' => $e->getMessage()],503);
    //     }
    // }
    public function destroy(Request $request)
    {
        try{
            $row = $this->carrierRepo->find($request->id);
            $all = $this->carrierRepo->all();
            $msg_type = '';
            if($row->type == 'Automatic'){
                $msg_type = 'Automatic';
            }else{
                if(count($all) < 2){
                    $msg_type = 'last_item';
                }elseif(count($row->shippingMethods) > 0){
                    $msg_type = 'has_shipping_method';
                }else{
                    $msg_type = 'deleted';
                }
                if($msg_type == 'deleted'){
                    $this->carrierRepo->delete($request->except('_token'));
                }
            }
            return $this->reloadWithData($msg_type);
        }catch(Exception $e){
            Toastr::error($e->getMessage(), 'Error!!');
            return response()->json(['error' => $e->getMessage()],503);
        }
    }
}
