<script>
    function quickView(product_id, type){
        $('#pre-loader').show();
        let payloadData = {
            _token:'{{ csrf_token() }}',
            product_id: product_id,
            type: type
        };
        $.post('{{ route('frontend.item.show_in_modal') }}', payloadData, function(data){
            $(".add-product-to-cart-using-modal").html(data);
            $("#theme_modal").modal('show');
            $('.nc_select, .select_address, #product_short_list, #paginate_by').niceSelect();
            $('#pre-loader').hide();
        });
    }
    function addToCart(product_sku_id, seller_id, qty, price, shipping_type, type, prod_info = null, giftCardType = null, auction_type=null) {
        // price=price.replace(',','');
        $('#add_to_cart_btn').prop('disabled',true);
        $('#add_to_cart_btn').html("{{__('defaultTheme.adding')}}");
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('price', price.replace(',',''));
        formData.append('qty', qty);
        formData.append('product_id', product_sku_id);
        formData.append('seller_id', seller_id);
        formData.append('shipping_method_id', shipping_type);
        formData.append('type', type);
        formData.append('is_buy_now', 'no');
        formData.append('gift_card_type', giftCardType);
        formData.append('auction_type', auction_type);
        $('#pre-loader').show();
        var base_url = $('#url').val();
        $.ajax({
            url: base_url + "/cart/store",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if(response.cart_details_submenu == 'out_of_stock'){
                    toastr.error('No more product to buy.');
                    $('#pre-loader').hide();
                    $('#add_to_cart_btn').prop('disabled',false);
                    $('#add_to_cart_btn').html("{{__('defaultTheme.add_to_cart')}}");
                }else{
                    $('#add_to_cart_btn').prop('disabled',false);
                    $('#add_to_cart_btn').html("{{__('defaultTheme.add_to_cart')}}");
                    if(prod_info != null){
                        $('#cart_suceess_thumbnail').attr('src', (prod_info.thumbnail).trim());
                        console.log(prod_info);
                        $('#cart_suceess_thumbnail').attr('alt', prod_info.name);
                        $('#cart_suceess_thumbnail').attr('title', prod_info.name);
                        $('#cart_suceess_name').text(prod_info.name);
                        $('#cart_suceess_price').text(prod_info.price);
                        $('#cart_suceess_url').attr('href',prod_info.url);
                        $('#cart_add_modal').modal('show');
                    }
                    $('#cart_data_show_div').html(response.cart_details_submenu);
                    $('.shoping_cart').addClass('active');
                    $('.cart_count_bottom').text(numbertrans(response.count_bottom));
                    if ($(".add-product-to-cart-using-modal").length){
                        $('.add_to_cart_modal').modal('hide');
                    }
                    $('#pre-loader').hide();
                }
            },
            error: function (response) {
                toastr.error("{{__('defaultTheme.product_not_added')}}","{{__('common.error')}}");
                $('#add_to_cart_btn').prop('disabled',false);
                $('#add_to_cart_btn').html("{{__('defaultTheme.add_to_cart')}}");
                $('#pre-loader').hide();
            }
        });
    }
    function cartProductDelete(id,p_id,btn_id){
        $('#pre-loader').show();
        $(btn_id).prop("disabled", true);
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('id', id);
        formData.append('p_id', p_id);
        var base_url = $('#url').val();
        $.ajax({
            url: base_url + "/cart/delete",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                toastr.success("{{__('defaultTheme.product_successfully_deleted_from_cart')}}", "{{__('common.success')}}");
                $('#cart_details_div').html(response.MainCart);
                $(btn_id).prop("disabled", false);
                $('#cart_data_show_div').html(response.SubmenuCart);
                $('.shoping_cart').addClass('active');
                $('.cart_count_bottom').text(numbertrans(response.count_bottom));
                $('#pre-loader').hide();
            },
            error: function (response) {
                $(btn_id).prop("disabled", false);
                $('#pre-loader').hide();
            }
        });
    }
    function deleteAlItem(){
        $('#delete_all_btn').prop("disabled", true);
        $('#pre-loader').show();
        var base_url = $('#url').val();
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        $.ajax({
            url: base_url + "/cart/delete-all",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                toastr.success("{{__('defaultTheme.product_successfully_deleted_from_cart')}}", "{{__('common.success')}}");
                $('#cart_details_div').empty();
                $('#cart_details_div').html(response.MainCart);
                $('#delete_all_btn').prop("disabled", false);
                $('#cart_inner').empty();
                $('#cart_inner').html(response.SubmenuCart);
                $('#pre-loader').hide();
            },
            error: function (response) {
                $('#delete_all_btn').prop("disabled", false);
                $('#pre-loader').hide();
            }
        });
    }
    function addToWishlist(seller_product_id, seller_id, type) {
        $('#wishlist_btn').addClass('wishlist_disabled');
        $('#wishlist_btn').html("{{__('defaultTheme.adding')}}");
        $('#pre-loader').show();
        $.post('{{ route('frontend.wishlist.store') }}', {_token:'{{ csrf_token() }}', seller_product_id:seller_product_id, seller_id:seller_id, type: type}, function(data){
            if(data.result == 1){
                toastr.success("{{__('defaultTheme.successfully_added_to_wishlist')}}","{{__('common.success')}}");
                $('#wishlist_btn').removeClass('wishlist_disabled');
                $('#wishlist_btn').html("{{__('defaultTheme.add_to_wishlist')}}");
                $('.wishlist_count').text(numbertrans(data.totalItems));
            }else if(data.result == 3){
                toastr.warning("{{__('defaultTheme.product_already_in_wishList')}}","{{__('defaultTheme.thanks')}}");
                $('#wishlist_btn').removeClass('wishlist_disabled');
                $('#wishlist_btn').html("{{__('defaultTheme.add_to_wishlist')}}");
            }
            else{
                toastr.error("{{__('common.error_message')}}","{{__('common.error')}}");
                $('#wishlist_btn').removeClass('wishlist_disabled');
                $('#wishlist_btn').html("{{__('defaultTheme.add_to_wishlist')}}");
            }
            $('#pre-loader').hide();
        });
    }
    function wishlistToggle(id){
        $('#'+id).addClass('is_wishlist');
    }
    function addToCompare(product_sku_id, product_type, type){
        if(product_sku_id && type){
            $('#pre-loader').show();
            let data = {
                '_token' : '{{ csrf_token() }}',
                'product_sku_id' : product_sku_id,
                'data_type' : type,
                'product_type' : product_type
            }
            $.post("{{route('frontend.compare.store')}}", data, function(response){
                if(response.msg == 'done'){
                    toastr.success("{{__('defaultTheme.product_added_to_compare_list_successfully')}}","{{__('common.success')}}");
                    $("#theme_modal").modal('hide');
                    $('.compare_count').text(numbertrans(response.totalItems));
                }else{
                    toastr.error("{{__('defaultTheme.not_added')}}","{{__('common.error')}}")
                }
                $('#pre-loader').hide();
            });
        }
    }
    function getFileName(value, placeholder){
        if (value) {
            var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
            var filename = value.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            $(placeholder).attr('placeholder', '');
            $(placeholder).attr('placeholder', filename);
        }
    }
    function imageChangeWithFile(input,srcId){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(srcId).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    function initLazyload(){
        setTimeout(() => {
            $('.lazyload').lazyload();
        }, 300);
    }
    function buyNow(product_sku_id, seller_id, qty, price, shipping_type, type, owner=null, giftCardType = null, auction_type=null) {
        console.log(auction_type);
        $('#butItNow').prop('disabled',true);
        $('#butItNow').html("{{__('defaultTheme.processing')}}");
        var formData = new FormData();
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('price', price);
        formData.append('qty', qty);
        formData.append('product_id', product_sku_id);
        formData.append('seller_id', seller_id);
        formData.append('shipping_method_id', shipping_type);
        formData.append('type', type);
        formData.append('is_buy_now', 'yes');

        formData.append('auction_type', auction_type);
        formData.append('gift_card_type', giftCardType);
        $('#pre-loader').show();
        var base_url = $('#url').val();
        $.ajax({
            url: base_url + "/cart/store",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                if(response.cart_details_submenu == 'out_of_stock'){
                    toastr.error('No more product to buy.');
                    $('#pre-loader').hide();
                    $('#butItNow').prop('disabled',false);
                    $('#butItNow').html("{{__('defaultTheme.but_it_now')}}");
                }else{
                    let checkout_type = "{{base64_encode('buy_it_now')}}";
                    let seller_wise_payment = "{{app('general_setting')->seller_wise_payment}}";
                    let = multi = "{{isModuleActive('MultiVendor')}}";
                    let checkout_url = base_url + '/checkout?checkout_type='+checkout_type+'&auction_type='+auction_type+'&auction_price='+price;
                    if(seller_wise_payment && multi){
                        checkout_url = base_url + '/checkout?checkout_type='+checkout_type+'&owner='+ owner+'&auction_type='+auction_type+'&auction_price='+price;
                    }
                    location.replace(checkout_url);
                }
            },
            error: function (response) {
                toastr.error("{{__('defaultTheme.product_not_added')}}","{{__('common.error')}}");
                $('#butItNow').prop('disabled',false);
                $('#butItNow').html("{{__('defaultTheme.but_it_now')}}");
                $('#pre-loader').hide();
            }
        });
    }
    function numbertrans(value){
        value = value.toString().split('');
        let transValue = '';
        let numders = [0,1,2,3,4,5,6,7,8,9];
        $.each(value,function(i,val){
            let translatedKey = 'numbers.'+ val;
            let translatedVal = trans(translatedKey);
            if(translatedKey == translatedVal){
                transValue += val;
            }else{
                transValue += translatedVal;
            }
        });
        return transValue;
    }
</script>
