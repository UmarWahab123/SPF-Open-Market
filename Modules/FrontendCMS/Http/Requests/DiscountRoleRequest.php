<?php

namespace Modules\FrontendCMS\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pricing_plan_id' => 'required|exists:pricing_plans,id',  
            'start_price' => 'required|numeric|min:0', 
            'end_price' => 'required|numeric|gt:start_price', 
            'discount' => 'nullable|numeric|min:0|max:100', 
            'status' => 'required|in:1,0', 
        ];
    }

    public function messages()
    {
        return [
            'pricing_plan_id.required' => 'The pricing plan field is required.',
            'pricing_plan_id.exists' => 'The selected pricing plan is invalid.',
            'start_price.required' => 'The start price is required.',
            'start_price.numeric' => 'The start price must be a valid number.',
            'start_price.min' => 'The start price must be at least 0.',
            'end_price.required' => 'The end price is required.',
            'end_price.numeric' => 'The end price must be a valid number.',
            'end_price.gt' => 'The end price must be greater than the start price.',
            'discount.required' => 'The discount percentage is required.',
            'discount.numeric' => 'The discount must be a valid number.',
            'discount.min' => 'The discount must be at least 0%.',
            'discount.max' => 'The discount must not exceed 100%.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
