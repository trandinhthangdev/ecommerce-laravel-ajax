<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - Client Ecommerce Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/client/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    @include('client.layouts.header')
    
    @yield('content')

    @include('client.layouts.footer')
    
    @if(Auth::check() && Auth::user()->role == 0)
    @include('client.layouts.cart-modal')   
    @else
    @include('client.layouts.login-register-modal')
    @endif
    <script src="assets/client/js/jquery.min.js"></script>
    <script src="assets/client/js/popper.min.js"></script>
    <script src="assets/client/js/bootstrap.min.js"></script>
    <script src="assets/client/js/toastr.min.js"></script>
    @stack('script')
    @if(Auth::check() && Auth::user()->role == 0)
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            function product_info(product_id)
            {
                var product_info;
                $.ajax({
                    async: false,
                    url : 'product_info.html',
                    type : 'POST',
                    data : {
                        product_id : product_id
                    },
                    dataType : 'JSON',
                    success : function(result){
                        product_info = result;
                    }
                });

                return product_info;
            }

            function show_cart()
            {
                $.ajax({
                    url : 'show_cart.html',
                    type : 'GET',
                    dataType : 'JSON',
                    success : function(result)
                    {
                        if(result != null)
                        {

                        }
                        var total = 0;
                        var html = '';
                        var count_cart = 0;
                        $.each(result, function(key, value){
                            count_cart ++;
                            html += '<tr>';
                            html += '<td class="w-25">';
                                html += '<img src="assets/uploads/products/thumbnail/' + product_info(value.product_id).thumbnail + '" class="img-fluid img-thumbnail">';
                            html += '</td>';
                            html += '<td>' + product_info(value.product_id).name + '</td>';
                            if(product_info(value.product_id).discount_status == 1)
                            {
                                var price = product_info(value.product_id).discount_price;
                            }
                            else
                            {
                                var price = product_info(value.product_id).price;
                            }

                            html += '<td>' + price + '</td>';
                            html += '<td class="w-25">';
                                html += '<div class="row">';
                                html += '<button class="badge badge-dark col-3" id="change_quantity" data-id="' + value.id + '" value="' + (parseInt(value.quantity)-1) + '"><span><i class="fa fa-minus"></i></span></button>';
                                // html += '<input type="number" class="col-6" name="qty" value ="' + value.quantity + '" min="1" max="' + product_info(value.product_id).quantity + '"/>';
                                html += '<span class="badge badge-light col-6">' + value.quantity + '</span>';
                                html += '<button class="badge badge-dark col-3" id="change_quantity" data-id="' + value.id + '" value="' + (parseInt(value.quantity)+1) + '"><span><i class="fa fa-plus"></i></span></button>';
                                html += '</div>';
                            html += '</td>';
                            total += price*value.quantity;
                            html += '<td>' + (price*value.quantity) + '</td>';
                            html += '<td>';
                                html += '<button class="btn btn-danger btn-sm" id="delete_product_cart" value="' + value.id + '">';
                                    html += '<i class="fa fa-times"></i>';
                                html += '</button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                        $('#count_cart').html(count_cart);
                        $('#show_cart').html(html);
                        $('#cart_total').html(total);

                    }
                });
            }
            function show_cart_check_out()
            {
                $.ajax({
                    url : 'show_cart.html',
                    type : 'GET',
                    dataType : 'JSON',
                    success : function(result)
                    {
                        var total = 0;
                        var html = '';
                        var count_cart = 0;
                        $.each(result, function(key, value){
                            count_cart ++;
                            html += '<li class="list-group-item d-flex justify-content-between lh-condensed">';
                                html += '<div>';
                                    html += '<span class="text-info">' + product_info(value.product_id).name + '</span>';
                                    html += '<br>';
                                    html += '<span class="badge badge-secondary badge-pill">' + value.quantity + '</span>';
                                html += '</div>';
                                if(product_info(value.product_id).discount_status == 1)
                                {
                                    var price = product_info(value.product_id).discount_price;
                                }
                                else
                                {
                                    var price = product_info(value.product_id).price;
                                }
                                total += price*value.quantity;
                                html += '<span class="text-muted">' + price + '</span>';
                            html += '</li>';
                        });
                        html += '<li class="list-group-item d-flex justify-content-between">';
                            html += '<span>Total (USD)</span>';
                            html += '<strong id="cart_total_check_out">' + total + '</strong>';
                        html += '</li>';

                        $('#count_cart_check_out').html(count_cart);
                        $('#show_cart_check_out').html(html);
                    }
                });
            }


            show_cart();
            show_cart_check_out();
            $(document).on('click', '#cart_product_id', function(){

                    product_id = $(this).val();
                    $.ajax({
                        url : 'add_to_cart.html',
                        type : 'POST',
                        data : {
                            product_id : product_id
                        },
                        dataType : 'JSON',
                        success : function(result){
                            if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response',{timeOut: 200});
                                show_cart(cart_customer_id);
                                show_cart_check_out(cart_customer_id)
                            }
                            else
                            {
                                toastr.error(result.response, 'Response',{timeOut: 200});
                            }
                        }                    
                    });
            });

            $(document).on('click', '#delete_product_cart', function(){
                var order_detail_id = $(this).val();
                $.ajax({
                    url : 'delete_product_cart.html',
                    type : 'POST',
                    data : {
                        order_detail_id : order_detail_id
                    },
                    dataType : 'JSON',
                    success : function(result){
                        if(result.res_type == 'success')
                        {
                            toastr.success(result.response, 'Response',{timeOut: 200});
                            show_cart(cart_customer_id);
                            show_cart_check_out(cart_customer_id)
                        }
                        else
                        {
                            toastr.error("Xóa sản phẩm trong giỏ hàng không thành công !", 'Response',{timeOut: 200});
                        }
                    }
                });
            });

            $(document).on('click', '#change_quantity', function(){
                var change_quantity = $(this).val();
                var order_detail_id = $(this).data('id');
                if(change_quantity == 0)
                {
                    toastr.error("Số lượng tối thiểu là 1, nếu bạn không mua bạn có thể Xóa sản phẩm trong giỏ hàng !", 'Response',{timeOut: 200});
                }
                else
                {
                    $.ajax({
                        url : 'update_quantity_order_detail.html',
                        type : 'POST',
                        data : {
                            order_detail_id : order_detail_id,
                            change_quantity : change_quantity
                        },
                        dataType : 'JSON',
                        success : function(result){
                            if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response',{timeOut: 400});
                                show_cart(cart_customer_id);
                                show_cart_check_out(cart_customer_id)
                            }
                            else
                            {
                                toastr.error(result.response, 'Response',{timeOut: 400});
                            }
                        }
                    });
                }
            });
            $('#check_out_btn').click(function(){
                var count_cart_check_out = $('#count_cart_check_out').html();
                if(count_cart_check_out == '0')
                {
                    toastr.error("Giỏ hàng bạn trống !", 'Response',{timeOut: 200});
                }
                else
                {
                    var order_detail = $('#check_out_show').html();
                    $.ajax({
                        url : 'check_out_post.html',
                        type : 'POST',
                        dataType : 'text',
                        data : {
                            order_detail : order_detail
                        },
                        success : function(result){
                            toastr.success(result, 'Response',{timeOut: 100});
                            setTimeout('location.reload();', 100);
                        }
                    });
                }
            });
        });
    </script>
    @else
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $(document).on('click', '#login_btn', function(){
                $('#login_form').on('submit', function(event){
                    event.preventDefault();
                    $.ajax({
                        url: 'login',
                        data: new FormData(this),
                        type: 'POST',
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(result){
                            if(result.res_type == 'error')
                            {
                                if(result.response.password)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.password[0];
                                    html += '</div>';
                                    $('#password_error_login').html(html);
                                }
                                else
                                {
                                    toastr.error(result.response, 'Response');
                                }
                            }
                            else if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response');
                                setTimeout("location.reload(true);",500);
                            }
                        }
                    });
                });
            });


            $(document).on('click', '#register_btn', function(){
                $('#register_form').on('submit', function(event){
                    event.preventDefault();
                    $.ajax({
                        url : 'register',
                        data: new FormData(this),
                        type: 'POST',
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(result){
                            if(result.res_type == 'error')
                            {
                                if(result.response.email)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.email[0];
                                    html += '</div>';
                                    $('#email_error_register').html(html);
                                } else if(result.response.password)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.password[0];
                                    html += '</div>';
                                    $('#password_error_register').html(html);
                                } else if(result.response.repeat_password)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.repeat_password[0];
                                    html += '</div>';
                                    $('#repeat_password_error_register').html(html);
                                } else if(result.response.name)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.name[0];
                                    html += '</div>';
                                    $('#name_error_register').html(html);
                                } else if(result.response.address)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.address[0];
                                    html += '</div>';
                                    $('#address_error_register').html(html);
                                } else if(result.response.phone)
                                {
                                    html = '';
                                    html += '<div class="alert alert-danger" role="alert">';
                                        html += result.response.phone[0];
                                    html += '</div>';
                                    $('#phone_error_register').html(html);
                                }
                            }
                            else if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response');
                                setTimeout("location.reload(true);",500);
                            }
                        }
                    });
                }); 
            });

            $(document).on('click', '#cart_product_id', function(){
                toastr.error("Bạn phải đăng nhập mới thêm sản phẩm vào giỏ hàng !", 'Response',{timeOut: 200});
            });
        });
    </script>
    @endif
</body>
</html>