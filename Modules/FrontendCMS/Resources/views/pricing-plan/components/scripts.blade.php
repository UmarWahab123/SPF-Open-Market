@push('scripts')
<script>
    (function($){
        "use strict";
        $(document).ready(function() {
            $(document).on('submit', '#item_delete_form', function(event) {
                event.preventDefault();
                $('#pre-loader').removeClass('d-none');
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', $('#delete_item_id').val());
                let id = $('#delete_item_id').val();
                $('#deleteItemModal').modal('hide');
                $.ajax({
                    url: "{{ route('admin.subscription-plan.delete') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetAfterChange(response.TableData);
                        toastr.success("{{__('common.deleted_successfully')}}","{{__('common.success')}}");
                        $('#pre-loader').addClass('d-none');
                        $.ajax({
                            url: "{{ route('admin.subscription-plan.create') }}",
                            type: "GET",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#formHtml').empty();
                                $('#formHtml').html(response.editHtml);
                                $('#monthly_cost').addClass(
                                    'has-content');
                                $('#yearly_cost').addClass(
                                    'has-content');
                                $('#pre-loader').addClass('d-none');
                                location.reload();
                            },
                            error: function(response) {
                                if(response.responseJSON.error){
                                    toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                                    $('#pre-loader').addClass('d-none');
                                    return false;
                                }
                                toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                                $('#pre-loader').addClass('d-none');
                            }
                        });
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                        }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });


            $("#add_pricing_form").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                console.log(formData);

                // Disable the submit button and show a loading state
                $("#create_btn").prop('disabled', true);
                $('#create_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');

                removeValidationError(); // Clear any previous validation errors

                $.ajax({
                    url: "{{ route('admin.subscription-plan.store') }}", // Store route for subscription plan
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success("{{__('common.added_successfully')}}", "{{__('common.success')}}");
                        location.reload(); // Reload the page on success
                    },
                    error: function (xhr) {
                        // Re-enable the submit button
                        $("#create_btn").prop('disabled', false);
                        $('#create_btn').text('{{ __("common.submit") }}');
                        $('#pre-loader').addClass('d-none');

                        // Handle validation errors (status code 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            showValidationErrors('#add_pricing_form', errors); // Pass the form ID and errors to showValidationErrors
                        } else {
                            // Handle any other types of errors
                            toastr.error("{{__('common.something_went_wrong')}}", "{{__('common.error')}}");
                        }
                    }
                });
            });

            $(document).on('submit', '#pricing_edit_form', function(event) {
                event.preventDefault(); // Prevent the default form submission

                var formData = new FormData(this);
                console.log(formData);

                // Disable the submit button and show a loading state
                $("#create_btn").prop('disabled', true);
                $('#create_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');

                removeValidationError(); // Clear any previous validation errors

                $.ajax({
                    url: "{{ route('admin.subscription-plan.update') }}", // Update route for subscription plan
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                        location.reload(); // Reload the page on success
                    },
                    error: function (xhr) {
                        // Re-enable the submit button
                        $("#create_btn").prop('disabled', false);
                        $('#create_btn').text('{{ __("common.submit") }}');
                        $('#pre-loader').addClass('d-none');

                        // Handle validation errors (status code 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            showValidationErrors('#pricing_edit_form', errors); // Pass the form ID and errors to showValidationErrors
                        } else {
                            // Handle any other types of errors
                            toastr.error("{{__('common.something_went_wrong')}}", "{{__('common.error')}}");
                        }
                    }
                });
            });


            $(document).on('change', '.statusChange', function(event){
                let item = $(this).data('value');
                $('#pre-loader').removeClass('d-none');
                var formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('id', item.id);
                formData.append('status', item.status);
                $.ajax({
                    url: "{{ route('admin.subscription-plan.status') }}",
                    type: "POST",
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        resetAfterChange(response.TableData);
                        toastr.success("{{__('common.updated_successfully')}}","{{__('common.success')}}");
                        $('#pre-loader').addClass('d-none');
                    },
                    error: function(response) {
                        if(response.responseJSON.error){
                        toastr.error(response.responseJSON.error ,"{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                        return false;
                        }
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                        $('#pre-loader').addClass('d-none');
                    }
                });
            });

            $(document).on('click', '.show_pricing', function(event){
                event.preventDefault();
                let item = $(this).data('value');
                $('#item_show').modal('show');
                @if(isModuleActive('FrontendMultiLang'))
                if (item.name != null) {
                    var cat_name = '';
                    $.each(item.name, function( key, value ) {
                        if(key == '{{auth()->user()->lang_code}}'){
                            cat_name = value;
                        }
                    });
                    $('#show_name').text(cat_name);
                }else{
                    $('#show_name').text(item.translateName);
                }
                @else
                $("#show_name").text(item.name);
                @endif
                $('#show_plan_price').text(numbertrans(item.plan_price));
                $('#show_expire_in').text(numbertrans(item.expire_in));
            });

            $(document).on('click', '.delete_pricing', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('#delete_item_id').val(id);
                $('#deleteItemModal').modal('show');
            });



            $(document).on('click', '.edit_pricing', function(event){
                event.preventDefault();
                let item = $(this).data('value');
                $('#pre-loader').removeClass('d-none');
                let baseUrl = $('#url').val();
                let url = baseUrl + '/admin/subscription-plan/' + item.id + '/edit'
                $.ajax({
                    url: url,
                    type: "GET",
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#formHtml').empty();
                        $('#formHtml').append(response.editHtml);
                        $('#pre-loader').addClass('d-none');
                        $('#item_id').val(item.id);
                        @if(isModuleActive('FrontendMultiLang'))
                        if (item.name != null) {
                            $.each(item.name, function( key, value ) {
                                $('#name_'+key).val(value);
                            });
                        }else{
                            $('#name_{{auth()->user()->lang_code}}').val(item.translateName);
                        }
                        @else
                        $('#name').val(item.name).addClass('has-content');
                        @endif

                        $("#plan_price").val(item.plan_price).addClass('has-content');
                        $("#expire_in").val(item.expire_in).addClass('has-content');
                        $('#best_for').val(item.best_for).addClass('has-content');
                        $("#old_image").val(item.image).addClass('has-content');
                        $("#discount").val(item.discount).addClass('has-content');
                        $("#description").val(item.description).addClass('has-content');
                        $('.summernote').summernote({
                            height: 200,
                            codeviewFilter: true,
			                codeviewIframeFilter: true
                        });
                        if(item.discount_type == 1)
                        {
                            $("#discount_type_percentage").prop("checked", true);
                        }else{
                            $("#discount_type_amount").prop("checked", true);
                        }

                        if (item.status == 1) {
                            $('#pricing_edit_form #status_active').prop("checked", true);
                            $('#pricing_edit_form #status_inactive').prop("checked", false);
                        } else {
                            $('#pricing_edit_form #status_active').prop("checked", false);
                            $('#pricing_edit_form #status_inactive').prop("checked", true);
                        }
                        if(item.is_featured == 1){
                            $('#pricing_edit_form #is_featured').prop("checked", true);
                        }else{
                            $('#pricing_edit_form #is_featured').prop("checked", false);
                        }

                        $("#gst_id").val(item.gst_tax_id).change();
                    },
                    error: function(response) {
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                    }
                });
            });
            function showValidationErrors(formType, errors) {
                // Handle multi-language error display for the 'name' field
                @if(isModuleActive('FrontendMultiLang'))
                    $(formType + ' #error_name_{{auth()->user()->lang_code}}').text(errors['name.{{auth()->user()->lang_code}}']);
                @else
                    $(formType + ' #error_name').text(errors.name);
                @endif

                // Display error for the 'status' field
                $(formType + ' #status_error').text(errors.status);
            }

            function resetAfterChange(tableData) {
                $('#item_table').empty();
                $('#item_table').html(tableData);
                CRMTableThreeReactive();
            }
            function resetForm() {
                $('#add_pricing_form')[0].reset();
            }
            function removeValidationError() {
                // Handle multi-language error removal for the 'name' field
                @if(isModuleActive('FrontendMultiLang'))
                    @foreach($LanguageList as $language)
                        $('#error_name_{{ $language->code }}').text('');
                    @endforeach
                @else
                    $('#error_name').text('');
                @endif;
                $('#status_error').text('');
            }
        });
    })(jQuery);
    $('.summernote').summernote({
        height: 200,
        codeviewFilter: true,
        codeviewIframeFilter: true,
        disableDragAndDrop:true,
        callbacks: {
            onImageUpload: function (files) {
                sendFile(files, '.summernote')
            }
        }
    });
</script>
@endpush
