<div class="row">
    <div class="col-lg-12">
        <div class="main-title">
            <h3 class="mb-30">
                Payment Information</h3>
        </div>

        <form action="{{route('seller.profile.seller-profile.update',$seller->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="white-box">
                <div class="add-visitor">
                <input type="hidden" name="id" value="{{$seller->id}}">
                {{-- <input type="hidden" name="payment_id" value="{{$seller->SellerPaymentsInfo->id}}"> --}}
                <input type="hidden" name="payment_id" value="{{ $seller->SellerPaymentsInfo?->id ?? '' }}">

                <input type="hidden" name="form_type" value="payment">


                 <div class="row">
                        <!-- Card Holder Name -->
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="card_holder_name">Card Holder Name<span class="text-danger">*</span></label>
                                <input 
                                    name="card_holder_name" 
                                    class="primary_input_field" 
                                    type="text" 
                                    value="{{ old('card_holder_name') ?: ($seller->SellerPaymentsInfo?->card_holder_name ?? '') }}" 
                                    placeholder="Enter Card Holder Name">
                                @error('card_holder_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    <!-- Card Number -->
                   <div class="col-xl-6">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="card_number">Card Number <span class="text-danger">*</span></label>
                            <input 
                                name="card_number" 
                                id="card_number" 
                                class="primary_input_field" 
                                type="text" 
                                value="{{ old('card_number') ?: ($seller->SellerPaymentsInfo?->card_number 
                                        ? str_repeat('*', strlen($seller->SellerPaymentsInfo->card_number) - 4) . substr($seller->SellerPaymentsInfo->card_number, -4) 
                                        : '') }}"
                                placeholder="Enter Card Number">
                            @error('card_number')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                        <!-- Expiry Date -->
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="expire_in">Expire In<span class="text-danger">*</span></label>
                                <input 
                                    name="expire_in" 
                                    class="primary_input_field" 
                                    type="text" 
                                    value="{{ old('expire_in') ?: ($seller->SellerPaymentsInfo?->expire_in ?? '') }}" 
                                    placeholder="MM/YY">
                                @error('expire_in')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                             <!-- Billing Address -->
                        <div class="col-xl-6">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="billing_address">Billing Address<span class="text-danger">*</span></label>
                               <input 
                                    name="billing_address" 
                                    class="primary_input_field" 
                                    type="text" 
                                    value="{{ old('billing_address') ?: ($seller->SellerPaymentsInfo?->PaymentBillingAddress?->billing_address ?? '') }}" 
                                    placeholder="Enter Billing Address">
                                @error('billing_address')
                                <span class="text-danger">{{ $message }}</span>
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

</div>
@include('backEnd.partials._deleteModalForAjax',
['item_name' => __('common.bank_cheque'),'modal_id' => 'cheqyeImgModal','form_id' => 'chequeImgForm','delete_item_id' => 'delete_cheque_id','dataDeleteBtn'=>'cheque_delete_btn'])


