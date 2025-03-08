<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
               Primary Contact Person</h3>
        </div>

        <form method="POST" action="{{route('seller.profile.seller-profile.update',$seller->id)}}" id="seller_account_form"
            accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="white-box">
                <div class="add-visitor">
                    <div class="row">
                        <input type="hidden" name="id" value="{{$seller->id}}">
                        <input type="hidden" name="form_type" value="primary">
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="first_name">{{__('common.first_name')}} <span
                                        class="text-danger">*</span></label>
                                <input name="first_name" class="primary_input_field" placeholder="-" type="text"
                                    value="{{ old('first_name')? old('first_name'):$seller->primary_first_name }}">
                                @error('first_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="last_name">{{__('common.last_name')}}</label>
                                <input name="last_name" class="primary_input_field" placeholder="-" type="text"
                                    value="{{ old('last_name')? old('last_name'):$seller->primary_last_name }}">
                            </div>
                        </div>
                         <div class="col-xl-6">
                            {{-- <div class="primary_input mb-25">
                                <label class="primary_input_label" for="last_name">Phone Number</label>
                                <input name="phone_number" class="primary_input_field" placeholder="-" type="text"
                                    value="{{ old('phone_number') ? old('phone_number') : $seller->SellerPhoneNumbers->sortByDesc(function($item) { return max($item->created_at, $item->updated_at);})->first()->phone_number }}">
                            </div> --}}
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="last_name">Phone Number</label>
                                <input 
                                    name="phone_number" 
                                    class="primary_input_field" 
                                    placeholder="-" 
                                    type="text"
                                    value="{{ old('seller_phone') ?? @$seller->SellerRegisteredBusiness->BusinessNumbers->sortByDesc(function($item) {return max($item->created_at, $item->updated_at);})->first()->phone_number }}">
                            </div>
                        
                   
                        </div>
                            <!-- Country of Citizenship -->
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="country_of_citizenship">Country of Citizenship</label>
                                <select name="country_of_citizenship" id="country_of_citizenship" class="primary_select">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}" 
                                            {{ (old('country_of_citizenship') ?: $seller->country_of_citizenship) == $country->name ? 'selected' : '' }}>
                                            {{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_of_citizenship')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="country_of_birth">Country of Birth</label>
                                <select name="country_of_birth" id="country_of_birth" class="primary_select">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}" 
                                            {{ (old('country_of_birth') ?: $seller->country_of_birth) == $country->name ? 'selected' : '' }}>
                                            {{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                    <!-- Date of Birth -->
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="date_of_birth">Date of Birth</label>
                            <input name="date_of_birth" class="primary_input_field" type="date"
                                value="{{ old('date_of_birth') ?: $seller->date_of_birth }}">
                            @error('date_of_birth')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                     <div class="col-xl-12">
                             <label style="font-size: 18px;" class="form-label">
                        Registered business address
                    </label>
                     </div>
                     <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="country">Business Country</label>
                                <select name="country" id="country" class="primary_select">
                                    <option value="" disabled selected>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->name}}" 
                                            {{ (old('country') ?: $seller->SellerRegisteredBusiness->country) == $country->name ? 'selected' : '' }}>
                                            {{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('country')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                      </div>
                    <!-- City/Town -->
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="city_town">City</label>
                            <input name="city_town" class="primary_input_field" type="text" placeholder="Enter City/Town"
                                value="{{ old('city_town') ?: $seller->city_town }}">
                            @error('city_town')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Line 1 -->
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="address_line1">Address Line1</label>
                            <input name="address_line1" class="primary_input_field" type="text" placeholder="Enter Address"
                                value="{{ old('address_line1') ?: $seller->address_line1 }}">
                            @error('address_line1')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- ZIP/Postal Code -->
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="zip_postal_code">Zip/Postal Code</label>
                            <input name="zip_postal_code" class="primary_input_field" type="text" placeholder="Enter ZIP/Postal Code"
                                value="{{ old('zip_postal_code') ?: $seller->zip_postal_code }}">
                            @error('zip_postal_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="appartment_building_suite_other">Apartment/Building/Suite/Other</label>
                            <input name="appartment_building_suite_other" class="primary_input_field" type="text" placeholder="Enter Apartment/Building/Suite/Other"
                                value="{{ old('appartment_building_suite_other') ?: $seller->appartment_building_suite_other }}">
                            @error('appartment_building_suite_other')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                     </div>
                       <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="state_region">State/Region</label>
                            <input name="state_region" class="primary_input_field" type="text" placeholder="Enter State/Region"
                                value="{{ old('state_region') ?: $seller->state_region }}">
                            @error('state_region')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                     </div>
                     <div class="col-xl-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label">Confirm if primary contact person</label>
                            
                            <!-- Beneficial Owner of the Business -->
                            <div style="margin-bottom: 10px; display: flex; align-items: center;">
                                <input type="checkbox" name="beneficial_owner_check" id="beneficial_owner_check" value="1"
                                    {{ old('beneficial_owner_check', $seller->beneficial_owner_check) == 1 ? 'checked' : '' }}
                                    style="margin-right: 10px;">
                                <label for="beneficial_owner_check" style="margin: 0; font-size: 16px; cursor: pointer;">
                                    Beneficial Owner of the Business
                                </label>
                            </div>
                            
                            <!-- Legal Representative of the Business -->
                            <div style="margin-bottom: 10px; display: flex; align-items: center;">
                                <input type="checkbox" name="legal_representative_check" id="legal_representative_check" value="1"
                                    {{ old('legal_representative_check', $seller->legal_representative_check) == 1 ? 'checked' : '' }}
                                    style="margin-right: 10px;">
                                <label for="legal_representative_check" style="margin: 0; font-size: 16px; cursor: pointer;">
                                    Legal Representative of the Business
                                </label>
                            </div>
                            
                            <!-- Primary Contact Person -->
                         <div style="margin-bottom: 10px;" class="mt-20">
                            <!-- Label -->
                            <label for="primary_contact_person_check" style="display: block; margin-bottom: 5px;">
                                Primary contact person is the only beneficial owner of the business
                            </label>
                        
                            <!-- Radio Buttons -->
                            <div style="display: flex; align-items: center;">
                                <div style="margin-right: 20px;">
                                    <input type="radio" name="primary_contact_person_check" id="primary_contact_person_yes" value="1"
                                        {{ old('primary_contact_person_check', $seller->primary_contact_person_check) == 1 ? 'checked' : '' }}>
                                    <label for="primary_contact_person_yes" style="cursor: pointer; margin-left: 5px;">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" name="primary_contact_person_check" id="primary_contact_person_no" value="0"
                                        {{ old('primary_contact_person_check', $seller->primary_contact_person_check) == 0 ? 'checked' : '' }}>
                                    <label for="primary_contact_person_no" style="cursor: pointer; margin-left: 5px;">No</label>
                                </div>
                            </div>
                                <div>
                                 @if ($seller->primary_contact_person_check == 0)
                                        <div id="owners-container" >
                                            @foreach(json_decode($seller->all_owner_data, true) ?? [] as $owner)
                                                <div class="owner-item" style="display: flex; align-items: center; margin-bottom: 10px; gap: 10px;">
                                                    <label style="margin-right: 5px;">{{ $owner['index'] }}</label>

                                                    <label style="margin-right: 5px;">Owner Name:</label>
                                                    <input type="text" name="owners[{{ $loop->index }}][ownerName]" value="{{ $owner['ownerName'] }}" class="primary_input_field" style="width: 150px;">

                                                    <label style="margin-right: 5px;">Percentage:</label>
                                                    <input type="text" name="owners[{{ $loop->index }}][percentage]" value="{{ $owner['percentage'] }}" class="primary_input_field" style="width: 70px;">

                                                    <!-- Hidden field to retain the index -->
                                                    <input type="hidden" name="owners[{{ $loop->index }}][index]" value="{{ $owner['index'] }}">
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <div id="owners-container" style="display: none;">
                                                @foreach(json_decode($seller->all_owner_data, true) ?? [] as $owner)
                                                    <div class="owner-item" style="display: flex; align-items: center; margin-bottom: 10px; gap: 10px;">
                                                        <label style="margin-right: 5px;">{{ $owner['index'] }}</label>

                                                        <label style="margin-right: 5px;">Owner Name:</label>
                                                        <input type="text" name="owners[{{ $loop->index }}][ownerName]" value="{{ $owner['ownerName'] }}" class="primary_input_field" style="width: 150px;">

                                                        <label style="margin-right: 5px;">Percentage:</label>
                                                        <input type="text" name="owners[{{ $loop->index }}][percentage]" value="{{ $owner['percentage'] }}" class="primary_input_field" style="width: 70px;">

                                                        <!-- Hidden field to retain the index -->
                                                        <input type="hidden" name="owners[{{ $loop->index }}][index]" value="{{ $owner['index'] }}">
                                                    </div>
                                                @endforeach
                                            </div>
                                    @endif
                                </div>
                        
                            <!-- Error Display -->
                            @error('primary_contact_person_check')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        </div>
                    </div>
                    {{-- <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <!-- Checkbox with Label -->
                                <label class="checkbox_design" style="align-items: center; font-size: 16px; cursor: pointer;">
                                    <input type="checkbox" name="confirmation_check" id="confirmation_check" value="1"
                                        {{ old('confirmation_check', $seller->confirmation_check) == 1 ? 'checked' : '' }}
                                        style="margin-right: 10px;">
                                    I confirm I am acting on my own behalf or on behalf of a registered business, and I commit to updating the beneficial ownership information whenever a change has been made.
                                </label>
                            </div>
                        
                            <!-- Error Message -->
                            <span class="text-danger" id="confirmation_check_error">
                                @error('confirmation_check') {{ $message }} @enderror
                            </span>

                    </div> --}}
                
                    </div>

                     <div class="row mt-40">
                    <div class="col-lg-12 text-center tooltip-wrapper" data-title="Click to update" title="">
                            <button class="primary-btn fix-gr-bg tooltip-wrapper" type="submit" id="sellerAccountBtn">
                                <span class="ti-check"></span>
                                {{ __('common.update') }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</div>
