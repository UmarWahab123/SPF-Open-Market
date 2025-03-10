@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{asset(asset_path('modules/frontendcms/css/widget.css'))}}" />
@endsection
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('frontendCms.home_page') }} </h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="white_box_50px box_shadow_white mb-40 min-height-630">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('frontendCms.section_list') }}</label>
                                <select name="unit_type_id" id="unit_type_id" class="primary_select mb-15" required="1">
                                    <option disabled selected>{{ __('common.select_one') }}</option>
                                    @foreach($widgets as $key => $widget)
                                    <option value="{{$widget->section_name}}">{{$widget->title}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <form id="widget_form" enctype="multipart/form-data">
                                <div class="row" id="form_appand">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="iframe_div">
                    <iframe id="myFrame" src="{{url('/')}}" frameborder="0"></iframe>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function(){
    $(document).on('change','#status',function(event){
        let val = 0;
        let form = $('#form_for').val();
        if ($('#status').is(":checked")){
        val = 1;
        $("#myFrame").contents().find('#'+form).removeClass('d-none');
        }else{
            val = 0;
            $("#myFrame").contents().find('#'+form).addClass('d-none');
        }
    });
    $(document).on('submit','#widget_form',function(event){
        event.preventDefault();
        $('#widget_form_btn').prop('disabled',true);
        $('#widget_form_btn').text('{{ __("common.updating") }}');
        $('#pre-loader').removeClass('d-none');
        let status = 0;
        if ($('#status').is(":checked")){
            status =1;
        }else{
            status = 0;
        }
        let formElement = $(this).serializeArray()
        let formData = new FormData();
        console.log("formData",formData);
        formElement.forEach(element => {
            formData.append(element.name, element.value);
        });

        if ($('#reviewer_image').length) {
            let image_file_length = document.getElementById('reviewer_image').files.length;
            console.log("test_image" , image_file_length);
            console.log("path_test" , document.getElementById('reviewer_image').files[0]);

            if (image_file_length == 1) {
                formData.append('review_image', document.getElementById('reviewer_image').files[0]);
            }
        }
        if($('#filter_category_image_2').length){
            let file_length = document.getElementById('filter_category_image_2').files.length;
            if(file_length == 1){
                formData.append('banner_image', document.getElementById('filter_category_image_2').files[0]);
            }
        }
        if($('#filter_category_image_3').length){
            let file_length = document.getElementById('filter_category_image_3').files.length;
            if(file_length == 1){
                formData.append('banner_image', document.getElementById('filter_category_image_3').files[0]);
            }
        }
        if($('#banner_image_1').length){
            let banner_file_1_length = document.getElementById('banner_image_1').files.length;
            if(banner_file_1_length == 1){
                formData.append('banner_image_1', document.getElementById('banner_image_1').files[0]);
            }
        }
        if($('#banner_image_2').length){
            let banner_file_2_length = document.getElementById('banner_image_2').files.length;
            if(banner_file_2_length == 1){
                formData.append('banner_image_2', document.getElementById('banner_image_2').files[0]);
            }
        }
        if($('#banner_image_3').length){
            let banner_file_3_length = document.getElementById('banner_image_3').files.length;
            if(banner_file_3_length == 1){
                formData.append('banner_image_3', document.getElementById('banner_image_3').files[0]);
            }
        }
         // Append video file if it exists
        if ($('#filter_category_video').length) {
            let video_file_length = document.getElementById('filter_category_video').files.length;
            console.log("test_image" , video_file_length);
            console.log("path_test" , document.getElementById('filter_category_video').files[0]);
            if (video_file_length === 1) {
                formData.append('filter_category_video', document.getElementById('filter_category_video').files[0]);
            }
        }
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('status', status);
        $.ajax({
            url: "{{ route('frontendcms.homepage.update') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                document.getElementById('myFrame').contentWindow.location.reload();
                $('#pre-loader').addClass('d-none');
                $('#widget_form_btn').prop('disabled',false);
                $('#widget_form_btn').text('{{ __("common.update") }}');
                removeValidate();
                toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
            },
            error: function(response) {
                $('#pre-loader').addClass('d-none');
                $('#widget_form_btn').prop('disabled',false);
                $('#widget_form_btn').text('{{ __("common.update") }}');
                if(response.responseJSON.error){
                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                    $('#pre-loader').addClass('d-none');
                }else{
                    showFormError(response.responseJSON.errors);
                    toastr.error("{{__('common.error_message')}}", "{{__('common.error')}}");
                }
            }
        });
    });
    $(document).on('change','#unit_type_id', function(){

        let value = $('#unit_type_id').val();
        $('#form_appand').empty();
        //$('#pre-loader').removeClass('d-none');
        let iframe = document.getElementById("myFrame");
        // let elmnt = iframe.contentWindow.document.getElementById($('#unit_type_id').val()).scrollIntoView({
        //     behavior: 'smooth',
        //     block: 'center',
        //     top: 100
        // });
        let formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('value', value);
        $.ajax({
            url: "{{ route('frontendcms.homepage.getsection-form') }}",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response);
                $('#form_appand').html(response);
                $('#column_size').niceSelect();
                $('#type').niceSelect();
                $('#product_list').niceSelect();
                $('#category_list').niceSelect();
                $('#category').niceSelect();
                $('#category_2').niceSelect();
                $('#category_3').niceSelect();
                $('#brand_list').niceSelect();
                $('#pre-loader').addClass('d-none');
                
                if(value == "top_bar"){
                    $("#hide_for_top_bar").hide();
                }

            },
            error: function(response) {
            }
        });
    });
    $(document).on('input', '#title', function(){
        @if(isModuleActive('FrontendMultiLang'))
        let value = $('#title{{auth()->user()->lang_code}}').val();
        @else
        let value = $('#title').val();
        @endif
        let form = $('#form_for').val();
        let title_id  = form +'_title'
        let iframe = document.getElementById("myFrame");
        let elmnt = iframe.contentWindow.document.getElementById(title_id);
        elmnt.textContent = value;
    });
    $(document).on('change', '#column_size', function(){
        let form = $('#form_for').val();
        let column_size = $(this).data('value');
        let value = $('#column_size').val();
        if ($('#status').is(":checked")){
            value += '';
        }else{
            value += ' d-none';
        }
        $("#myFrame").contents().find('#'+form).removeAttr('class');
        $("#myFrame").contents().find('#'+form).attr('class',value);
    });
    $(document).on('change', '.product_type', function(){
        let value = $('.product_type').val();
        if(value ==6){
            $('#product_list_div').removeClass('d-none');
            $('#product_list').niceSelect();
        }else{
            $('#product_list_div').addClass('d-none');
        }
    });
    $(document).on('change', '.category_type ', function(){
        let value = $('.category_type').val();
        if(value ==6){
            $('#category_list_div').removeClass('d-none');
            $('#category_list').niceSelect();
        }else{
            $('#category_list_div').addClass('d-none');
        }
    });
    $(document).on('change', '.brand_type', function(){
        let value = $('.brand_type').val();
        if(value ==6){
            $('#brand_list_div').removeClass('d-none');
            $('#brand_list').niceSelect();
        }else{
            $('#brand_list_div').addClass('d-none');
        }
    });
    function showFormError(error){
        $('#is_featured_error').text(error.status);
        $('#error_title').text(error.title);
        $('#coulmn_size_error').text(error.column_size);
        $('#type_error').text(error.type);
    }
    function removeValidate(){
        $('#is_featured_error').text('');
        $('#error_title').text('');
        $('#coulmn_size_error').text('');
        $('#type_error').text('');
    }
    $(document).on('change', '.image_file', function(event){
        let name_id = $(this).data('name_id');
        let view_id = $(this).data('view_id');
        getFileName($(this).val(),name_id);
        imageChangeWithFile($(this)[0], view_id);
    });
});
</script>
@endpush
