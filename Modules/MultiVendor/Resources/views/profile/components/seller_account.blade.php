<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
                {{__('common.seller')}} {{__('common.account')}}</h3>
        </div>

        <form method="POST" action="{{route('seller.profile.seller-profile.update',$seller->id)}}" id="seller_account_form"
            accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="white-box">
                <div class="add-visitor">
                    <div class="row">
                        <input type="hidden" name="id" value="{{$seller->id}}">
                        <input type="hidden" name="form_type" value="seller">

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label d-inline" for="">{{__('common.seller')}}
                                    {{__('common.id')}} :</label> <strong>{{$seller->sellerAccount->seller_id}}</strong>

                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="first_name">Name <span
                                        class="text-danger">*</span></label>
                                <input name="first_name" class="primary_input_field" placeholder="-" type="text"
                                    value="{{ old('first_name')? old('first_name'):$seller->first_name }}">
                                @error('first_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                           <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="email">{{__('common.email_address')}} <span
                                        class="text-danger">*</span></label>
                                <input name="email" class="primary_input_field" placeholder="-" type="text"
                                    value="{{ old('email')? old('email'):$seller->email }}">
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                         <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="first_name">Company Name <span
                                        class="text-danger">*</span></label>
                                <input name="seller_company_name" class="primary_input_field" placeholder="Company Name" type="text"
                                    value="{{ old('seller_company_name')? old('seller_company_name'):$seller->seller_company_name }}">
                                @error('seller_company_name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        

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
