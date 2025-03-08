@if(isModuleActive('FrontendMultiLang'))
@php
$LanguageList = getLanguageList();
@endphp
@endif
<div class="col-xl-12" style="display: none">
    <div class="primary_input">
        <ul id="theme_nav" class="permission_list sms_list ">
            <li>
                <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                    <input name="status" id="status" value="1" {{$data->status?'checked':''}} type="checkbox">
                    <span class="checkmark"></span>
                </label>
                <p>{{__('appearance.enable_this_section') }}</p>
            </li>
        </ul>
        <span class="text-danger" id="is_featured_error"></span>
    </div>
    <input type="hidden" id="form_for" name="form_for" value="{{$data->section_name}}">
    <input type="hidden" name="id" value="{{$data->id}}">
</div>
<div id="hide_for_top_bar" class="row w-100">
    @if(isModuleActive('FrontendMultiLang'))
        <div class="col-lg-12">
            <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5" role="tablist">
                @foreach ($LanguageList as $key => $language)
                    <li class="nav-item lang_code" data-id="{{$language->code}}">
                        <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif" href="#element{{$language->code}}" role="tab" data-toggle="tab" aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content">
                @foreach ($LanguageList as $key => $language)
                    <div role="tabpanel" class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif" id="element{{$language->code}}" style="display: none;">
                        <div class="primary_input mb-15">
                            <label class="primary_input_label" for="title"> {{ __('common.title') }} <span class="text-danger">*</span></label>
                            <input class="primary_input_field" name="title[{{$language->code}}]" id="title{{$language->code}}" placeholder="{{ __('common.title') }}" type="text" value="{{isset($data)?$data->getTranslation('title',$language->code):old('title.'.$language->code)}}">
                            <span class="text-danger" id="error_title_{{$language->code}}"></span>
                        </div>
                    </div>
                @endforeach
            </div>
            <textarea id="textarea" class="form_for" placeholder="Enter additional information"></textarea>
        </div>
    @else
        <div class="col-xl-12" style="display:none;">
            <div class="primary_input mb-15">
                <label class="primary_input_label" for="title"> {{__('common.title') }} <span class="text-danger">*</span></label>
                <input class="primary_input_field" name="title" id="title" placeholder="{{ __('common.title') }}" type="text" value="{{$data->title}}">
                <span class="text-danger" id="error_title"></span>
            </div>
        </div>
    @endif
    <div class="col-lg-12 @if(app('theme')->folder_path != 'default') d-none @endif">
        <div class="primary_input mb-25">
            <label class="primary_input_label" for="">{{ __('appearance.column_size') }}</label>
            <select name="column_size" id="column_size" class="primary_select mb-15" data-value="{{$data->column_size}}">
                <option disabled selected>{{__('common.select') }}</option>
                <option {{$data->column_size =='col-lg-3'?'selected':'' }} value="col-lg-3">{{__('appearance.3_column')}}</option>
                <option {{$data->column_size =='col-lg-4'?'selected':'' }} value="col-lg-4">{{__('appearance.4_column')}}</option>
                <option {{$data->column_size =='col-lg-6'?'selected':'' }} value="col-lg-6">{{__('appearance.6_column')}}</option>
                <option {{$data->column_size =='col-lg-12'?'selected':'' }} value="col-lg-12">{{__('appearance.12_column')}}</option>
            </select>
            <span class="text-danger" id="coulmn_size_error"></span>
        </div>
    </div>


    {{-- new start --}}
    <div>
            {{-- first section  start--}}
        @if($get_req['value'] == 'best_deals')
            <label class="primary_input_label">Heading</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Unlock Growth with Transparency.....">{{$homepagedata->heading}}</textarea>
            <label class="primary_input_label">Paragraph</label>
            <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join SPF Open Market for exclusive.....">{{$homepagedata->paragraph}}</textarea>

            

            {{-- second section  start--}}
        @elseif($get_req['value'] == 'top_brands')
            <label class="primary_input_label">Heading</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Empower Your Business and Connect.....">{{$homepagedata->heading}}</textarea>
            <label class="primary_input_label">Paragraph</label>
            <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Always know you're getting the best deal with.....">{{$homepagedata->paragraph}}</textarea>
           <div class="primary_input mb-25">
                <label class="primary_input_label" for="">{{__('video') }} (MP4 format){{__('mb')}}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="filter_category_video_file" placeholder="{{__('browse video file')}}" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="filter_category_video">{{__("common.browse")}} </label>
                        <input type="file" class="d-none video_file" accept="video/mp4" name="filter_category_video" id="filter_category_video" data-name_id="#filter_category_video_file" data-view_id="#filter_category_video_show" onchange="previewVideo(event)">
                    </button>
                </div>
                @error('filter_category_video')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form_video_div">
                   <video id="filter_category_video_show" src="{{ showImage('images/reviews/'. $homepagedata->field_1 ?? 'backend/img/default.mp4') }}" controls style="max-width: 100%; height: auto;"></video>
                </div>
            </div>

            <script>
                function previewVideo(event) {
                    const fileInput = event.target;
                    const video = document.getElementById('filter_category_video_show');

                    // Check if the file is selected and is a valid video
                    if (fileInput.files && fileInput.files[0]) {
                        const fileURL = URL.createObjectURL(fileInput.files[0]); // Create URL for the selected video
                        video.src = fileURL;  // Set the video element source to the file URL
                        video.load();          // Load the new video file
                        video.play();          // Play the video
                    }
                }
            </script>

            @elseif($get_req['value'] == 'top_picks')
                <label class="primary_input_label">Main Heading</label>
                <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="How it Works.....">{{$homepagedata->heading}}</textarea>
                <label class="primary_input_label"  >First Heading</label>
                <input id="heading_input_1" style="margin-bottom: 5px;" name="heading_input_1" class="primary_input_field" value="{{$homepagedata->heading1}}"  placeholder="transparency">
                <textarea id="paragraph_text_area1" name="paragraph_text_area1" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Eliminate guesswork with complete.....">{{$homepagedata->paragraph1}}</textarea>
                <label class="primary_input_label">Second Heading</label>
                <input id="heading_input_2" style="margin-bottom: 5px;" name="heading_input_2" class="primary_input_field" value="{{$homepagedata->heading2}}"  placeholder="transparency">
                <textarea id="paragraph_text_area2" name="paragraph_text_area2" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Get the best deal with transparent.....">{{$homepagedata->paragraph2}}</textarea>
                <label class="primary_input_label">Third Heading</label>
                <input id="heading_input_3" style="margin-bottom: 5px;" name="heading_input_3" class="primary_input_field" value="{{$homepagedata->heading3}}"  placeholder="transparency">
                <textarea id="paragraph_text_area3" name="paragraph_text_area3" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join an elite, members-only club.....">{{$homepagedata->paragraph3}}</textarea>
                <label class="primary_input_label">Right description</label>
                <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join SPF Open Market for exclusive.....">{{$homepagedata->paragraph}}</textarea>
 

        @elseif($get_req['value'] == 'feature_categories')
            <label class="primary_input_label">Heading</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Flexible Membership and Subscription Plans.....">{{$homepagedata->heading}}</textarea>
            <label class="primary_input_label">Paragraph</label>
            <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Discover how joining our elite club can elevate.....">{{$homepagedata->paragraph}}</textarea>
        
        
        
        @elseif($get_req['value'] == 'more_products')
            <label class="primary_input_label">Main Heading</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="How it Works.....">{{$homepagedata->heading}}</textarea>
          
                    <label class="primary_input_label">First Heading</label>
                    <input id="heading_input_1" style="margin-bottom: 5px;" name="heading_input_1" class="primary_input_field" value="{{$homepagedata->heading1}}"  placeholder="transparency">
                    <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join SPF Open Market for exclusive.....">{{$homepagedata->paragraph}}</textarea>
                    {{-- <textarea id="section1_description" name="section1_description" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Eliminate guesswork with complete....."></textarea> --}}
                    <label class="primary_input_label">Second Heading</label>
                   <input id="heading_input_2" style="margin-bottom: 5px;" name="heading_input_2" class="primary_input_field" value="{{$homepagedata->heading2}}"  placeholder="transparency">
                    <textarea id="paragraph_text_area1" name="paragraph_text_area1" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Eliminate guesswork with complete.....">{{$homepagedata->paragraph1}}</textarea>
                    <label class="primary_input_label">Third Heading</label>
                     <input id="heading_input_3" style="margin-bottom: 5px;" name="heading_input_3" class="primary_input_field" value="{{$homepagedata->heading3}}"  placeholder="transparency">
                    <textarea id="paragraph_text_area2" name="paragraph_text_area2" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Get the best deal with transparent.....">{{$homepagedata->paragraph2}}</textarea>
                    <label class="primary_input_label">Fourth Heading</label>
                    <input id="heading_input_4" style="margin-bottom: 5px;" name="heading_input_4" class="primary_input_field" value="{{$homepagedata->heading4}}"  placeholder="transparency">
                    <textarea id="paragraph_text_area3" name="paragraph_text_area3" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join an elite, members-only club.....">{{$homepagedata->paragraph3}}</textarea>


        @elseif($get_req['value'] == 'filter_category_1')
                <label class="primary_input_label" for="">{{__('video') }} (MP4 format){{__('mb')}}</label>
                <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="filter_category_video_file" placeholder="{{__('browse video file')}}" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="filter_category_video">{{__("common.browse")}} </label>
                        <input type="file" class="d-none video_file" accept="video/mp4" name="filter_category_video" id="filter_category_video" data-name_id="#filter_category_video_file" data-view_id="#filter_category_video_show" onchange="previewVideo(event)">
                    </button>
                </div>
                @error('filter_category_video')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form_video_div">
                    <video id="filter_category_video_show" src="{{ showImage('images/reviews/'. $homepagedata->field_1 ?? 'backend/img/default.mp4') }}" controls style="max-width: 100%; height: auto;"></video>
                </div>
            </div>

            <script>
                function previewVideo(event) {
                    const fileInput = event.target;
                    const video = document.getElementById('filter_category_video_show');

                    // Check if the file is selected and is a valid video
                    if (fileInput.files && fileInput.files[0]) {
                        const fileURL = URL.createObjectURL(fileInput.files[0]); // Create URL for the selected video
                        video.src = fileURL;  // Set the video element source to the file URL
                        video.load();          // Load the new video file
                        video.play();          // Play the video
                    }
                }
            </script>
            <label class="primary_input_label">Reviews Title</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Unlock Growth with Transparency.....">{{$homepagedata->heading}}</textarea>
            <label class="primary_input_label">Reviews description</label>
            <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join SPF Open Market for exclusive.....">{{$homepagedata->paragraph}}</textarea>
                   <div class="primary_input mb-25" style="padding-right: 40px;">
                        <label class="primary_input_label" for="">Reviewer Image ({{ getNumberTranslate(148) }} X {{ getNumberTranslate(148) }}){{ __('common.px') }}</label>
                            <div class="primary_file_uploader">
                                <input class="primary-input" type="text" id="reviewer_image_file" placeholder="{{ __('common.browse_image_file') }}" readonly="">
                                <button type="button">
                                    <label class="primary-btn small fix-gr-bg" for="reviewer_image">{{ __("common.browse") }} </label>
                                    <input type="file" class="d-none" accept="image/*" name="reviewer_image" id="reviewer_image" data-name_id="#reviewer_image_file" data-view_id="#reviewer_image_show" onchange="previewReviewerImage(event)">
                                </button>
                            </div>
                            @error('reviewer_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form_img_div">
                                {{-- <img id="reviewer_image_show" src="{{ showImage($homepagedata->field_2 ? 'public/images/reviews/' . $homepagedata->field_2 : 'backend/img/default.png') }}" alt="Default Image" style="max-width: 100%; height: auto;"> --}}
                                <img id="reviewer_image_show" src="{{ showImage('images/reviews/'. $homepagedata->field_2 ?? 'backend/img/default.png') }}" alt="Default Image" style="max-width: 100%; height: auto;">
                            </div>

                            <script>
                                function previewReviewerImage(event) {
                                    const fileInput = event.target;
                                    const image = document.getElementById('reviewer_image_show');

                                    if (fileInput.files && fileInput.files[0]) {
                                        const fileURL = URL.createObjectURL(fileInput.files[0]);
                                        image.src = fileURL;
                                    }
                                }
                            </script>


                    <label class="primary_input_label"  >Reviewer Name</label>
                    <input id="heading_input_1" style="margin-bottom: 5px;" name="heading_input_1" class="primary_input_field"  value="{{$homepagedata->heading1}}"   placeholder="transparency">  
                    <label class="primary_input_label"  >Position</label>
                    <input id="heading_input_2" style="margin-bottom: 5px;" name="heading_input_2" class="primary_input_field" value="{{$homepagedata->heading2}}"  placeholder="transparency"> 

         @elseif($get_req['value'] == 'top_rating')
           {{-- Video Upload --}}
            <label class="primary_input_label" for="">{{__('video') }} (MP4 format){{__('mb')}}</label>
            <div class="primary_file_uploader">
                <input class="primary-input" type="text" id="filter_category_video_file" placeholder="{{__('browse video file')}}" readonly>
                <button type="button">
                    <label class="primary-btn small fix-gr-bg" for="filter_category_video">{{__("common.browse")}}</label>
                    <input type="file" class="d-none video_file" accept="video/mp4" name="filter_category_video" id="filter_category_video" data-name_id="#filter_category_video_file" data-view_id="#filter_category_video_show" onchange="previewVideo(event)">
                </button>
            </div>
            @error('filter_category_video')
                <span class="text-danger">{{$message}}</span>
            @enderror
            <div class="form_video_div">
                <video id="filter_category_video_show" src="{{ showImage('images/reviews/'. $homepagedata->field_1 ?? 'backend/img/default.mp4') }}" controls style="max-width: 100%; height: auto;"></video>
                {{-- <video id="filter_category_video_show" src="{{ $data->customSection->field_video ?? 'backend/video/default.mp4' }}" controls style="max-width: 100%; height: auto;"></video> --}}
                {{-- <img id="reviewer_image_show" src="{{ showImage('images/reviews/'. $homepagedata->field_2 ?? 'backend/img/default.png') }}" alt="Default Image" style="max-width: 100%; height: auto;"> --}}
            </div>

            <script>
                  function previewVideo(event) {
                        const fileInput = event.target;
                        const video = document.getElementById('filter_category_video_show');
                        if (fileInput.files && fileInput.files[0]) {
                            const fileURL = URL.createObjectURL(fileInput.files[0]);
                            video.src = fileURL;
                            video.load();
                            video.play();
                        }
                    }
            </script>
             <label class="primary_input_label">Reviews Title</label>
            <textarea id="heading_text_area" name="heading_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Unlock Growth with Transparency.....">{{$homepagedata->heading}}</textarea>
            <label class="primary_input_label">Reviews description</label>
            <textarea id="paragraph_text_area" name="paragraph_text_area" class="primary_input_field" style="width: 327px; height: 170px;" placeholder="Join SPF Open Market for exclusive.....">{{$homepagedata->paragraph}}</textarea>
                   <label class="primary_input_label" for="">Reviewer Image ({{ getNumberTranslate(148) }} X {{ getNumberTranslate(148) }}){{ __('common.px') }}</label>
                        <div class="primary_file_uploader">
                            <input class="primary-input" type="text" id="reviewer_image_file" placeholder="{{ __('common.browse_image_file') }}" readonly="">
                            <button type="button">
                                <label class="primary-btn small fix-gr-bg" for="reviewer_image">{{ __("common.browse") }} </label>
                                <input type="file" class="d-none" accept="image/*" name="reviewer_image" id="reviewer_image" data-name_id="#reviewer_image_file" data-view_id="#reviewer_image_show" onchange="previewReviewerImage(event)">
                            </button>
                        </div>
                        @error('reviewer_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form_img_div">
                            <img id="reviewer_image_show" src="{{ showImage('images/reviews/'. $homepagedata->field_2 ?? 'backend/img/default.png') }}" alt="Default Image" style="max-width: 100%; height: auto;">
                        </div>

                        <script>
                            function previewReviewerImage(event) {
                                const fileInput = event.target;
                                const image = document.getElementById('reviewer_image_show');

                                if (fileInput.files && fileInput.files[0]) {
                                    const fileURL = URL.createObjectURL(fileInput.files[0]);
                                    image.src = fileURL;
                                }
                            }
                        </script>

                    <label class="primary_input_label"  >Reviewer Name</label>
                    <input id="heading_input_1" style="margin-bottom: 5px;" name="heading_input_1" class="primary_input_field" value="{{$homepagedata->heading1}}"    placeholder="transparency">  
                    <label class="primary_input_label"  >Position</label>
                    <input id="heading_input_2" style="margin-bottom: 5px;" name="heading_input_2" class="primary_input_field"  value="{{$homepagedata->heading2}}"  placeholder="transparency"> 
        @else
             <label class="primary_input_label" >No Such Section avilable</label>
        @endif
    </div>
    

    {{-- new end --}}

    <div style="display:none">
        @if ($data->section_for ==1)
            <div id="for_product_type" class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.type') }}</label>
                    <select name="type" id="type" class="primary_select mb-15 product_type">
                        <option {{$data->type == 1?'selected':''}} value="1">{{__('frontendCms.category_products')}}</option>
                        <option {{$data->type == 2?'selected':''}} value="2">{{__('frontendCms.latest_products')}}</option>
                        <option {{$data->type == 3?'selected':''}} value="3">{{__('frontendCms.recently_viewed_products')}}</option>
                        <option {{$data->type == 4?'selected':''}} value="4">{{__('frontendCms.max_sale')}}</option>
                        <option {{$data->type == 5?'selected':''}} value="5">{{__('frontendCms.max_review')}}</option>
                        <option {{$data->type == 6?'selected':''}} value="6">{{__('frontendCms.custom_products')}}</option>
                    </select>
                    <span class="text-danger" id="type_error"></span>
                </div>
            </div>
        @endif
        @if ($data->section_for ==2)
            <div id="for_product_type" class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.type') }}</label>
                    <select name="type" id="type" class="primary_select mb-15 category_type">
                        <option {{$data->type == 1?'selected':''}} value="1">{{__('frontendCms.top_category')}}</option>
                        <option {{$data->type == 2?'selected':''}} value="2">{{__('frontendCms.latest_category')}}</option>
                        <option {{$data->type == 3?'selected':''}} value="3">{{__('frontendCms.max_sale')}}</option>
                        <option {{$data->type == 4?'selected':''}} value="4">{{__('frontendCms.max_review')}}</option>
                        <option {{$data->type == 5?'selected':''}} value="5">{{__('frontendCms.amount_of_product')}}</option>
                        <option {{$data->type == 6?'selected':''}} value="6">{{__('frontendCms.custom_category')}}</option>
                    </select>
                    <span class="text-danger" id="type_error"></span>
                </div>
            </div>
        @endif
        @if ($data->section_for ==3)
            <div id="for_product_type" class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.type') }}</label>
                    <select name="type" id="type" class="primary_select mb-15 brand_type">
                        <option {{ $data->type == 1?'selected':'' }} value="1">{{__('frontendCms.top_brands')}}</option>
                        <option {{ $data->type == 2?'selected':'' }} value="2">{{__('frontendCms.latest_brands')}}</option>
                        <option {{ $data->type == 3?'selected':'' }} value="3">{{__('frontendCms.featured_brands')}}</option>
                        <option {{ $data->type == 4?'selected':'' }} value="4">{{__('frontendCms.max_sale')}}</option>
                        <option {{ $data->type == 5?'selected':'' }} value="5">{{__('frontendCms.max_review')}}</option>
                        <option {{ $data->type == 6?'selected':'' }} value="6">{{__('frontendCms.custom_brands')}}</option>
                    </select>
                    <span class="text-danger" id="type_error"></span>
                </div>
            </div>
        @endif
        @if ($data->section_for ==1)
            <div id="product_list_div" class="col-lg-12 {{$data->type != 6? 'd-none':''}}">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('appearance.product_list') }}</label>
                    <select name="product_list[]" id="product_list" class="primary_select mb-15" multiple>
                        @foreach($products as $key => $product)
                        <option @if($data->products->where('seller_product_id',$product->id)->first()) selected @endif value="{{$product->id}}">{{$product->product->product_name}} @if(isModuleActive('MultiVendor'))[ @if($product->seller->role->type == 'seller') {{$product->seller->first_name}} @else {{__('common.inhouse')}} @endif] @endif</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
        @endif
        @if ($data->section_for ==2)
            <div id="category_list_div" class="col-lg-12 {{$data->type != 6? 'd-none':''}}">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.category_list') }}</label>
                    <select name="category_list[]" id="category_list" class="primary_select mb-15" multiple>
                        @foreach($categories as $key => $category)
                        <option @if($data->categories->where('category_id',$category->id)->first()) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
        @endif
        @if ($data->section_for ==3)
            <div id="brand_list_div" class="col-lg-12 {{$data->type != 6? 'd-none':''}}">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('frontendCms.brand_list') }}</label>
                    <select name="brand_list[]" id="brand_list" class="primary_select mb-15" multiple>
                        @foreach($brands as $key => $brand)
                        <option @if($data->brands->where('brand_id',$brand->id)->first()) selected @endif value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
        @endif
        @if($data->section_for == 4 && $data->section_name == 'filter_category_1')
            <input type="hidden" name="type" value="{{$data->type}}">
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.category_list') }}</label>
                    <select name="category" id="category" class="primary_select mb-15">
                        @foreach($categories->where('parent_id', 0) as $key => $category)
                            <option {{@$data->customSection->field_1 == $category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('frontendCms.section_image') }} ({{getNumberTranslate(330)}} X {{getNumberTranslate(860)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="filter_category_image_file" placeholder="{{__('common.browse_image_file')}}" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="filter_category_image">{{__("common.browse")}} </label>
                        <input type="file" class="d-none image_file" accept="image/*" name="filter_category_image" id="filter_category_image" data-name_id="#filter_category_image_file" data-view_id="#filter_category_image_show">
                    </button>
                </div>
                    @error('filter_category_image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form_img_div">
                        <img id="filter_category_image_show" src="{{ showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png') }}" alt="">
                    </div>
                </div>
            </div>
        @elseif($data->section_for == 4 && $data->section_name == 'filter_category_2')
            <input type="hidden" name="type" value="{{$data->type}}">
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.category_list') }}</label>
                    <select name="category" id="category_2" class="primary_select mb-15">
                        @foreach($categories->where('parent_id', 0) as $key => $category)
                            <option {{@$data->customSection->field_1 == $category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('frontendCms.section_image') }} ({{getNumberTranslate(330)}} X {{getNumberTranslate(860)}}){{__('common.px')}}</label>fgj
                    <div class="primary_file_uploader">
                    <input class="primary-input" type="text" id="filter_category_image_file" placeholder="{{__('common.browse_image_file')}}" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg" for="filter_category_image">{{__("common.browse")}} </label>
                        <input type="file" class="d-none image_file" accept="image/*" name="filter_category_image" id="filter_category_image" data-name_id="#filter_category_image_file" data-view_id="#filter_category_image_show">
                    </button>
                </div>
                    @error('filter_category_image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form_img_div">
                        <img id="filter_category_image_show_2" src="{{ showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png') }}" alt="">
                    </div>
                </div>
            </div>
        @elseif($data->section_for == 4 && $data->section_name == 'filter_category_3')
            <input type="hidden" name="type" value="{{$data->type}}">
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('common.category_list') }}</label>
                    <select name="category" id="category_3" class="primary_select mb-15">
                        @foreach($categories->where('parent_id', 0) as $key => $category)
                            <option {{@$data->customSection->field_1 == $category->id?'selected':''}} value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('frontendCms.section_image') }} ({{getNumberTranslate(330)}} X {{getNumberTranslate(860)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader" data-toggle="amazuploader" data-multiple="false" data-type="image" data-name="filter_category_image">
                        <input class="primary-input file_amount" type="text" id="filter_category_image_file" placeholder="{{__('common.browse_image_file')}}" readonly="">
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="filter_category_image">{{__('common.browse') }} </label>
                            <input type="hidden" class="selected_files" value="{{old('filter_category_image')}}">
                        </button>
                    </div>
                    <div class="product_image_all_div">
                        <img id="filter_category_image_show_3" src="{{ showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png') }}" alt="">
                    </div>
                </div>
            </div>
        @elseif($data->section_for == 4 && $data->section_name == 'discount_banner')
            <input type="hidden" name="type" value="{{$data->type}}">
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('frontendCms.section_image_1') }} ({{getNumberTranslate(450)}} X {{getNumberTranslate(300)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="banner_image_file_1" placeholder="{{__('common.browse_image_file')}}" readonly="">
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="banner_image_1">{{__("common.browse")}} </label>
                            <input type="file" class="d-none image_file" accept="image/*" name="banner_image_1" id="banner_image_1" data-name_id="#banner_image_file_1" data-view_id="#banner_image_show_1">
                        </button>
                    </div>
                    @error('banner_image_1')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form_img_div">
                    <img id="banner_image_show_1" src="{{ showImage($data->customSection->field_1?$data->customSection->field_1:'backend/img/default.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="section_1_link"> {{__('frontendCms.section_1_link')}} <span class="text-danger">*</span> </label>
                    <input class="primary_input_field" type="text" id="section_1_link" value="{{$data->customSection->field_4}}" name="section_1_link" autocomplete="off"  placeholder="{{__('common.link')}}">
                    <span class="text-danger" id="error_section_1_link"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="banner_image_file_2">{{__('frontendCms.section_image_2') }} ({{getNumberTranslate(450)}} X {{getNumberTranslate(300)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="banner_image_file_2" placeholder="{{__('common.browse_image_file')}}" readonly="">
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="banner_image_2">{{__("common.browse")}} </label>
                            <input type="file" class="d-none image_file" accept="image/*" name="banner_image_2" id="banner_image_2" data-name_id="#banner_image_file_2" data-view_id="#banner_image_show_2">
                        </button>
                    </div>
                    @error('banner_image_2')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form_img_div">
                    <img id="banner_image_show_2" src="{{ showImage($data->customSection->field_2?$data->customSection->field_2:'backend/img/default.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="name"> {{__('frontendCms.section_2_link')}} <span class="text-danger">*</span> </label>
                    <input class="primary_input_field" type="text" id="section_2_link" value="{{$data->customSection->field_5}}" name="section_2_link" autocomplete="off"  placeholder="{{__('common.link')}}">
                    <span class="text-danger" id="error_section_2_link"></span>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{__('frontendCms.section_image_3') }} ({{getNumberTranslate(450)}} X {{getNumberTranslate(300)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="banner_image_file_3" placeholder="{{__('common.browse_image_file')}}" readonly="">
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="banner_image_3">{{__("common.browse")}} </label>
                            <input type="file" class="d-none image_file" accept="image/*" name="banner_image_3" id="banner_image_3" data-name_id="#banner_image_file_3" data-view_id="#banner_image_show_3">
                        </button>
                    </div>
                    @error('banner_image_3')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form_img_div">
                    <img id="banner_image_show_3" src="{{ showImage($data->customSection->field_3?$data->customSection->field_3:'backend/img/default.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="name"> {{__('frontendCms.section_3_link')}} <span class="text-danger">*</span></label>
                    <input class="primary_input_field" type="text" id="section_3_link" value="{{$data->customSection->field_6}}" name="section_3_link" autocomplete="off"  placeholder="{{__('common.link')}}">
                    <span class="text-danger" id="error_section_3_link"></span>
                </div>
            </div>
        @elseif ($data->section_for ==5)
        <input type="hidden" name="type" value="{{$data->type}}">
        @endif
    </div>
</div>

    @if (permissionCheck('frontendcms.homepage.update'))
        <div class="col-xl-6 offset-xl-3">
            <button class="primary_btn_2 mt-5" id="widget_form_btn"><i class="ti-check"></i>{{ __('common.update') }} </button>
        </div>
    @endif




