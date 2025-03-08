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
                    url: "{{ route('admin.discount.role.delete') }}",
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
                            url: "{{ route('admin.discount-role.create') }}",
                            type: "GET",
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#formHtml').empty();
                                $('#formHtml').html(response.editHtml);
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


            $("#add_discount_role_form").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                console.log(formData);

                $("#create_btn").prop('disabled', true);
                $('#create_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');
                removeValidationError(); // Clear previous errors

                $.ajax({
                    url: "{{ route('admin.discount-role.store') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success("{{__('common.added_successfully')}}", "{{__('common.success')}}");
                        location.reload(); // Reload the page upon success
                    },
                    error: function (xhr) {
                        // Enable the submit button again
                        $("#create_btn").prop('disabled', false);
                        $('#create_btn').text('{{ __("common.submit") }}');
                        $('#pre-loader').addClass('d-none');

                        // Check if it's a validation error (status code 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            showValidationErrors('#add_discount_role_form', errors); // Pass the form ID and errors to showValidationErrors function
                        } else {
                            // Handle other types of errors if necessary
                            toastr.error("{{__('common.something_went_wrong')}}", "{{__('common.error')}}");
                        }
                    }
                });
            });

            $(document).on('submit', '#discount_role_edit_form', function(event) {
                event.preventDefault();

                var formData = new FormData(this);
                console.log(formData);

                // Disable the submit button and show a loading state
                $("#create_btn").prop('disabled', true);
                $('#create_btn').text('{{ __("common.submitting") }}');
                $('#pre-loader').removeClass('d-none');

                removeValidationError(); // Clear any existing validation errors

                $.ajax({
                    url: "{{ route('admin.discount.role.update') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        toastr.success("{{__('common.updated_successfully')}}", "{{__('common.success')}}");
                        location.reload(); // Reload the page upon success
                    },
                    error: function (xhr) {
                        // Re-enable the submit button
                        $("#create_btn").prop('disabled', false);
                        $('#create_btn').text('{{ __("common.submit") }}');
                        $('#pre-loader').addClass('d-none');

                        // Handle validation errors (status code 422)
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            showValidationErrors('#discount_role_edit_form', errors); // Pass the form ID and errors to showValidationErrors
                        } else {
                            // Handle any other types of errors if needed
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
                    url: "{{ route('admin.discount.role.status') }}",
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

            $(document).on('click', '.show_discount_role', function(event){
                event.preventDefault();
                let item = $(this).data('value');
                console.log(item);
                $('#item_show').modal('show');
                $('#show_plan_name').text(item.pricing_plan.name);
                $('#show_start_price').text(numbertrans(item.start_price));
                $('#show_end_price').text(numbertrans(item.end_price));
                $('#show_discount').text(numbertrans(item.discount));
            });

            $(document).on('click', '.delete_discount_role', function(event){
                event.preventDefault();
                let id = $(this).data('id');
                $('#delete_item_id').val(id);
                $('#deleteItemModal').modal('show');
            });

            $(document).on('click', '.edit_discount_role', function(event){
                event.preventDefault();
                let item = $(this).data('value');
                $('#pre-loader').removeClass('d-none');
                let baseUrl = $('#url').val();
                let url = baseUrl + '/admin/discount-role/' + item.id + '/edit'
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
                        $("#pricing_plan_id").val(item.pricing_plan_id).change();
                        $("#start_price").val(item.start_price).addClass('has-content');
                        $("#end_price").val(item.end_price).addClass('has-content');
                        $("#discount").val(item.discount).addClass('has-content');

                        if (item.status == 1) {
                            $('#discount_role_edit_form #status_active').prop("checked", true);
                            $('#discount_role_edit_form #status_inactive').prop("checked", false);
                        } else {
                            $('#discount_role_edit_form #status_active').prop("checked", false);
                            $('#discount_role_edit_form #status_inactive').prop("checked", true);
                        }
                    },
                    error: function(response) {
                        toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                    }
                });
            });
            function showValidationErrors(formType, errors) {
                // console.log("formType",formType,"errors",errors)

                $(formType + ' #error_pricing_plan').text('');
                $(formType + ' #error_start_price').text('');
                $(formType + ' #error_end_price').text('');
                $(formType + ' #error_discount').text('');
                $(formType + ' #status_error').text('');

                // Display validation errors for each field
                if (errors.pricing_plan_id) {
                    $(formType + ' #error_pricing_plan').text(errors.pricing_plan_id[0]);
                }

                if (errors.start_price) {
                    $(formType + ' #error_start_price').text(errors.start_price[0]);
                }

                if (errors.end_price) {
                    $(formType + ' #error_end_price').text(errors.end_price[0]);
                }

                if (errors.discount) {
                    $(formType + ' #error_discount').text(errors.discount[0]);
                }

                if (errors.status) {
                    $(formType + ' #status_error').text(errors.status[0]);
                }
            }


            function resetAfterChange(tableData) {
                $('#item_table').empty();
                $('#item_table').html(tableData);
                CRMTableThreeReactive();
            }
            function resetForm() {
                $('#add_discount_role_form')[0].reset();
            }
            function removeValidationError() {
                // Clear error messages for start price, end price, discount, pricing plan, and status
                $('#error_start_price').text('');
                $('#error_end_price').text('');
                $('#error_discount').text('');
                $('#error_pricing_plan').text('');
                $('#status_error').text('');
            }

        });
    })(jQuery);
</script>
@endpush
