<div class="col-lg-12">
    <div class="main-title">
        <h3 class="mb-30">
            {{__('common.business_information')}} </h3>
    </div>
{{-- {{url('/profile/seller-business/update')}} --}}
    <form method="POST" action="{{route('seller.profile.seller-profile.update',$seller->id)}}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="white-box">
            <div class="add-visitor">
           <input type="hidden" name="business_id" value="{{$seller->SellerRegisteredBusiness->id}}">
           <input type="hidden" name="id" value="{{$seller->id}}">
           <input type="hidden" name="form_type" value="business">


           <div class="row">

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="business_name">Business Name <span class="text-danger">*</span></label>
                    <input name="business_name" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('business_name') ?? $seller->SellerRegisteredBusiness->business_name }}">
                    @error('business_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="company_registration_number">Company Registration Number <span class="text-danger">*</span></label>
                    <input name="company_registration_number" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('company_registration_number') ?? $seller->SellerRegisteredBusiness->company_registration_number }}">
                    @error('company_registration_number')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="phone_number">Phone Number <span class="text-danger">*</span></label>
                    <input name="phone_number" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('seller_phone') ?? @$seller->SellerRegisteredBusiness->BusinessNumbers->sortByDesc(function($item) {return max($item->created_at, $item->updated_at);})->first()->phone_number }}">
                    @error('seller_phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
         <div class="col-xl-12">
                             <label style="font-size: 18px;" class="form-label">
                        Registered business address
                    </label>
                     </div>

            <div class="col-xl-6">
                <label class="primary_input_label" for="country">{{__('seller.country_region')}} <span class="text-danger">*</span></label>
                <select name="country" id="business_country" class="primary_select mb-25">
                    <option value="" disabled selected>{{__('common.select_one')}}</option>
                    @foreach($countries as $country)
                    <option {{@$seller->SellerRegisteredBusiness->country == $country->name ? 'selected' : ''}} value="{{$country->name}}">{{$country->name}}</option>
                    @endforeach
                </select>
                @error('country')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="zip_postal_code">{{ __('common.postcode') }} <span class="text-danger">*</span></label>
                    <input name="zip_postal_code" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('zip_postal_code') ?? $seller->SellerRegisteredBusiness->zip_postal_code }}">
                    @error('zip_postal_code')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="address_line1"> Address Line1 <span class="text-danger">*</span></label>
                    <input name="address_line1" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('address_line1') ?? $seller->SellerRegisteredBusiness->address_line1 }}">
                    @error('address_line1')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

               <div class="col-xl-6">
                    <div class="primary_input mb-25">
                        <label class="primary_input_label" for="appartment_building_suite_other">Appartment</label>
                        <input name="appartment_building_suite_other" class="primary_input_field" placeholder="-" type="text"
                            value="{{ old('appartment_building_suite_other') ?? $seller->SellerRegisteredBusiness->appartment_building_suite_other }}">
                        @error('appartment_building_suite_other')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                 <!-- City / Town -->
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="city_town">{{ __('common.city') }} <span class="text-danger">*</span></label>
                    <input name="city_town" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('city_town') ? old('city_town') : $seller->SellerRegisteredBusiness->city_town }}">
                    @error('city_town')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>

            <!-- State / Region -->
            <div class="col-xl-6">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="state_region">State/Region <span class="text-danger">*</span></label>
                    <input name="state_region" class="primary_input_field" placeholder="-" type="text"
                        value="{{ old('state_region') ? old('state_region') : $seller->SellerRegisteredBusiness->state_region }}">
                    @error('state_region')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            </div>
                <div class="row mt-40">
                    <div class="col-lg-12 text-center tooltip-wrapper" data-title=""
                         data-original-title="" title="">
                        <button class="primary-btn fix-gr-bg tooltip-wrapper" type="submit" id="copyrightBtn">
                            <span class="ti-check"></span>
                            {{__('common.update')}} </button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@include('backEnd.partials._deleteModalForAjax',
['item_name' => __('common.business_document'),'modal_id' => 'imgModal','form_id' => 'imgForm','delete_item_id' => 'delete_document_id','dataDeleteBtn'=>'document_delete_btn'])
