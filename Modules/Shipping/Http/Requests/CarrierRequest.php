<?php

namespace Modules\Shipping\Http\Requests;

use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarrierRequest extends FormRequest
{
    public function rules()
    {
        if (isModuleActive('FrontendMultiLang')) {
            $code = auth()->user()->lang_code;
            return [
                'name.'. $code  =>  ['required', UniqueTranslationRule::for('carriers', 'name')->where(function($q){
                    $seller_id = getParentSellerId();
                    return $q->where('created_by', $seller_id);
                })->ignore($this->id)],
                'handling_charges' => ['required', 'numeric', 'min:0'],
                'client_id'        => ['required', 'string'],
                'client_secret'    => ['required', 'string'],
                'audience'         => ['required', 'string'],
                'auth_url'         => ['required', 'url'],
                'url'              => ['required', 'url'],
                'package_type'     => ['required', 'string'],
            ];
        } else {
            return [
                'name' =>  ['required', Rule::unique('carriers', 'name')->where(function($q){
                    $seller_id = getParentSellerId();
                    return $q->where('id', '!=', $this->id)->where('created_by', $seller_id);
                })],
                'handling_charges' => ['required', 'numeric', 'min:0'],
                'client_id'        => ['required', 'string'],
                'client_secret'    => ['required', 'string'],
                'audience'         => ['required', 'string'],
                'auth_url'         => ['required', 'url'],
                'url'              => ['required', 'url'],
                'package_type'     => ['required', 'string'],
            ];
        }
    }
    
    public function messages()
    {
        if (isModuleActive('FrontendMultiLang')) {
            return [
                'name.*.required' => 'The name field is required',
                'name.*.UniqueTranslationRule' => 'The name field has already been taken',
                'handling_charges.required' => 'The handling charges field is required',
                'handling_charges.numeric' => 'The handling charges must be a number',
                'handling_charges.min' => 'The handling charges must be at least 0',
                'client_id.required' => 'The client ID field is required',
                'client_secret.required' => 'The client secret field is required',
                'audience.required' => 'The audience field is required',
                'auth_url.required' => 'The auth URL field is required',
                'auth_url.url' => 'The auth URL must be a valid URL',
                'url.required' => 'The URL field is required',
                'url.url' => 'The URL must be a valid URL',
                'package_type.required' => 'The package type field is required',
                'package_type.in' => 'The selected package type is invalid',
            ];
        } else {
            return [
                'name.required' => 'The name field is required',
                'name.unique' => 'The name field has already been taken',
                'handling_charges.required' => 'The handling charges field is required',
                'handling_charges.numeric' => 'The handling charges must be a number',
                'handling_charges.min' => 'The handling charges must be at least 0',
                'client_id.required' => 'The client ID field is required',
                'client_secret.required' => 'The client secret field is required',
                'audience.required' => 'The audience field is required',
                'auth_url.required' => 'The auth URL field is required',
                'auth_url.url' => 'The auth URL must be a valid URL',
                'url.required' => 'The URL field is required',
                'url.url' => 'The URL must be a valid URL',
                'package_type.required' => 'The package type field is required',
                'package_type.in' => 'The selected package type is invalid',
            ];
        }
    }
    
    public function authorize()
    {
        return true;
    }
    
}
