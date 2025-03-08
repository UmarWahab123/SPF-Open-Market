<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
                Questions </h3>
        </div>

        <form method="POST" action="{{route('seller.profile.seller-profile.update',$seller->id)}}" id="warehouse_address_form" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="white-box">
                <div class="add-visitor">
                    <div class="row">
                        <input type="hidden" name="business_id" value="{{$seller->SellerRegisteredBusiness->id}}">
                        <input type="hidden" name="form_type" value="question">
                     <div class="col-xl-12">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="registerd_business_locations ">1. Where is your business registered?<br>
If you don't have a business, enter your county of residence. <span class="text-danger">*</span></label>
                            <input name="registerd_business_locations" class="primary_input_field" placeholder="-" type="text"
                                value="{{ old('registerd_business_locations ') ?? $seller->SellerRegisteredBusiness->registerd_business_locations  }}">
                            @error('registerd_business_locations ')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        </div>

                         <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    Business Name <span class="text-danger">*</span></label>
                                    <input name="solo_business_name" class="primary_input_field" placeholder="Business name" type="text"
                                        value="{{ old('solo_business_name') ?? $seller->SellerRegisteredBusiness->solo_business_name  }}">
                                    @error('solo_business_name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    Good and services type:    <span class="text-danger">*</span></label>
                                    <input name="Good_services_type" class="primary_input_field" placeholder="Good Services Type" type="text"
                                        value="{{ old('Good_services_type') ?? $seller->SellerRegisteredBusiness->Good_services_type  }}">
                                    @error('Good_services_type')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                     Overall Transaction Volume estimates:  <span class="text-danger">*</span></label>
                                    <input name="transaction_estimates" class="primary_input_field" placeholder="Overall Transaction Volume estimates" type="text"
                                        value="{{ old('transaction_estimates') ?? $seller->SellerRegisteredBusiness->transaction_estimates  }}">
                                    @error('transaction_estimates')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    How many locations: <span class="text-danger">*</span></label>
                                    <input name="How_many_locations" class="primary_input_field" placeholder="How many locations" type="number"
                                        value="{{ old('How_many_locations') ?? $seller->SellerRegisteredBusiness->How_many_locations  }}">
                                    @error('How_many_locations')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                     List locations states:  <span class="text-danger">*</span></label>
                                    {{-- <textarea name="List_locations_states" class="primary_input_field" style="height:70px;" placeholder="e.g., California, Texas, New York" type="text"
                                        >{{ old('List_locations_states') ?? $seller->SellerRegisteredBusiness->List_locations_states  }}</textarea> --}}
                                  <textarea name="List_locations_states" class="primary_input_field" style="height:70px;" placeholder="e.g., California, Texas, New York">
                                        <?php
                                                $states = json_decode($seller->SellerRegisteredBusiness->List_locations_states, true);

                                                if (is_array($states)) {
                                                    echo htmlspecialchars(implode(", ", $states), ENT_QUOTES, 'UTF-8');
                                                } else {
                                                    echo "";
                                                } 
                                        ?>
                                    </textarea>

                                    @error('List_locations_states')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25 h-4">
                                    Company description:  <span class="text-danger">*</span></label>
                                    <textarea name="company_description" class="primary_input_field"  style="height:70px;" placeholder="Company description:  ">{{ old('company_description') ?? $seller->SellerRegisteredBusiness->company_description }}</textarea>
                                    @error('company_description')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                            </div>
        
          <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="business_type">
                    2. What type of business do you have? <span class="text-danger">*</span>
                </label>
                <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
                    <!-- State-owned business -->
                    {{-- <div style="margin-bottom: 10px; display: flex; align-items: center;">
                        <input type="radio" name="business_type" id="state_owned" value="state_owned"
                            class="amazy-radio-input" 
                            {{ old('business_type', $seller->SellerRegisteredBusiness->business_type) == 'state_owned' ? 'checked' : '' }}
                            style="margin-right: 10px;">
                        <label for="state_owned" style="margin: 0; font-size: 16px; cursor: pointer;">State-owned business</label>
                    </div> --}}
        
                    <!-- Publicly-listed business -->
                    <div style="margin-bottom: 10px; display: flex; align-items: center;">
                        <input type="radio" name="business_type" id="publicly_listed" value="publicly_listed"
                            class="amazy-radio-input" 
                            {{ old('business_type', $seller->SellerRegisteredBusiness->business_type) == 'publicly_listed' ? 'checked' : '' }}
                            style="margin-right: 10px;">
                        <label for="publicly_listed" style="margin: 0; font-size: 16px; cursor: pointer;">Publicly-listed business</label>
                    </div>
        
                    <!-- Privately-owned business -->
                    <div style="margin-bottom: 10px; display: flex; align-items: center;">
                        <input type="radio" name="business_type" id="privately_owned" value="privately_owned"
                            class="amazy-radio-input" 
                            {{ old('business_type', $seller->SellerRegisteredBusiness->business_type) == 'privately_owned' ? 'checked' : '' }}
                            style="margin-right: 10px;">
                        <label for="privately_owned" style="margin: 0; font-size: 16px; cursor: pointer;">Privately-owned business</label>
                    </div>
                    <div style="margin-top: -8px; margin-left: 25px;">
                        <p>
                          You have selected to register as a privately-owned business, which is controlled and operated by private individuals. The business seller is registered in the context of a commercial or professional activity.
                        </p>
                    </div>
        
                    <!-- Individual -->
                    <div style="margin-bottom: 10px; display: flex; align-items: center;">
                        <input type="radio" name="business_type" id="individual" value="individual"
                            class="amazy-radio-input" 
                            {{ old('business_type', $seller->SellerRegisteredBusiness->business_type) == 'individual' ? 'checked' : '' }}
                            style="margin-right: 10px;">
                        <label for="individual" style="margin: 0; font-size: 16px; cursor: pointer;">Individual (I don't have a registered business)</label>
                    </div>
                </div>
                <span class="text-danger" id="business_type_error">
                    @error('business_type') {{ $message }} @enderror
                </span>
            </div>
        </div>



         <div class="col-xl-12">
            <div class="primary_input mb-25">
                <label class="primary_input_label" for="business_type">
                    3. Stores Information <span class="text-danger">*</span>
                </label>
                 
                <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 15px; border-radius: 8px;">
                    {{-- <table>
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode(  $seller->SellerRegisteredBusiness->all_stores_data) as $key => $store)
                                <tr >
                                    <td><input style="border: none;" type="text" name="stores[{{ $key }}][index]" value="{{ $store->index }}"></td>
                                    <td><input type="text"  class="primary_input_field" name="stores[{{ $key }}][name]" value="{{ $store->name }}"></td>
                                    <td><input type="text" style="width: 405px"  class="primary_input_field" name="stores[{{ $key }}][address]" value="{{ $store->address }}"></td>
                                   
                                </tr>
                            @endforeach
                             <input type="hidden" class="Stores_Information" id="Stores_Information">
                        </tbody>
                    </table> --}}

                    <table>
                        <thead>
                            <tr>
                                <th>Index</th>
                                <th>Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode($seller->SellerRegisteredBusiness->all_stores_data) as $key => $store)
                            <tr>
                                <td>
                                    <input
                                        style="border: none;"
                                        type="text"
                                        class="store-index"
                                        name="stores[{{ $key }}][index]"
                                        value="{{ $store->index }}">
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        class="primary_input_field store-name"
                                        name="stores[{{ $key }}][name]"
                                        value="{{ $store->name }}">
                                </td>
                                <td>
                                    <input
                                        type="text"
                                        style="width: 405px"
                                        class="primary_input_field store-address"
                                        name="stores[{{ $key }}][address]"
                                        value="{{ $store->address }}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Hidden Input Field -->
                    <input type="hidden" name="Stores_Information" id="Stores_Information">
                </div>
                <span class="text-danger" id="business_type_error">
                    @error('business_type') {{ $message }} @enderror
                </span>
            </div>
        </div>


                    </div>

                    <div class="row mt-40">
                      <div class="col-lg-12 text-center tooltip-wrapper" data-title="" data-original-title="" title="">
                            <button class="primary-btn fix-gr-bg tooltip-wrapper" type="submit" id="copyrightBtn">
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