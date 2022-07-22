<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div
                    class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Giả hàng</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                                <li class="active" aria-current="page">Giỏ hàng</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <?php
    if(Cart::count()==0){
    ?>
    <div
        class="col-lg-12"
        style="text-align: center; margin-top: 100px; margin-bottom: 100px"
    >
        <img src="../themes/bkweb/assets/images/icon/no-shopping-cart.jpg">
        <h3>Giỏ hàng của bạn không có sản phẩm nào!!!</h3>
        <div class="btn btn-primary">
            <a href="{{url('/')}}" style="color: #ffff">Mua hàng</a>
        </div>
    </div>
    <?php
    }
    else{
        ?>

    <!-- Start Cart Table -->

    <div class="cart-table-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <form action="{{ url('/update-cart-quantity')}}" method="POST">
                        <div class="table_page table-responsive">

                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                    <tr>
                                        <th class="product_remove">Xóa</th>
                                        <th class="product_thumb">Ảnh</th>
                                        <th class="product_name">Sản phẩm</th>
                                        <th class="product-price">Giá</th>
                                        <th class="product_quantity">số lượng</th>
                                        <th class="product_total">Tổng tiền</th>
                                    </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                    <!-- Start Cart Single Item-->

                                    <?php
                                    $content=Cart::content();
                                    ?>
                                    @foreach($content as $con )

                                            @csrf
                                                <tr>
                                                    <input type="hidden" value="{{$con->rowId}}" name="row" class="form-control"/>
                                                    <td class="product_remove"><a href="{{ url('/delete-cart'.'/'.$con->rowId) }}"><i class="fa fa-trash-o"></i></a></td>
                                                    <td class="product_thumb"><a href=""><img
                                                                src="{{ $con->options->images }}"
                                                                alt=""></a></td>
                                                    <td class="product_name"><a href="product-details-default.html">{{ $con->name }}</a></td>
                                                    <td class="product-price">{{ number_format($con->price) }} <sup>đ</sup></td>
                                                    <td class="product_quantity">
                                                        <div class="quantity" style="display: grid;grid-template-columns: 32% 36% 32%;">
                                                            <div class="minus"></div>
                                                            <input min="1" max="" inputmode="numeric" step="1"
                                                                   value="{{ $con->qty }}" type="number" name="cart[{{$con->rowId}}][qty]">
                                                            <div class="plus"><i></i><i></i></div>
                                                        </div>
                                                    </td>
                                                    <td class="product_total">
                                                        {{ number_format($con->price*$con->qty) }}

                                                    </td>
                                                </tr>

                                    <!-- End Cart Single Item-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
                            <button type="submit">cập nhật</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->

    <!-- Start Coupon Start -->
    <div class="coupon_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
{{--                    <div class="coupon_code left">--}}
{{--                        <h3>Coupon</h3>--}}
{{--                        <div class="coupon_inner">--}}
{{--                            <p>Enter your coupon code if you have one.</p>--}}
{{--                            <input placeholder="Coupon code" type="text">--}}
{{--                            <button type="submit">Apply coupon</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right">
                        <h3>Tổng tiền giỏ hàng</h3>
                        <div class="coupon_inner">

                            <div class="cart_subtotal">
                                <p>Tổng tiền :   </p>
                                <p class="cart_amount" style="color: #f30c28">{{ Cart::subtotal() . '' .'đ'}}</p>
                            </div>
                            <div class="checkout_btn">
                                <a href="{{ route('checkout') }}">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Coupon Start -->

        <?php
        }
        ?>
</div> <!-- ...:::: End Cart Section:::... -->


{{--<script>--}}
{{--    class LwmCart {--}}
{{--        constructor() {--}}
{{--            this.cart_form = $('#cart-form');--}}
{{--            this.checkout_form = $('#checkout-form');--}}
{{--            this.cart_update = this.cart_form.attr('action');--}}
{{--            this.cart_checkout = this.checkout_form.attr('action');--}}
{{--            this.customer_key = 'cart_customer';--}}
{{--        }--}}

{{--        init() {--}}
{{--            this.add_to_cart();--}}
{{--            this.validate_checkout_form();--}}
{{--            this.quantity_click();--}}
{{--            this.checkout_click();--}}
{{--            this.checkbox_action();--}}
{{--            this.load_customer();--}}
{{--        }--}}

{{--        loading(active = true) {--}}
{{--            if (active) {--}}
{{--                $('.cart-section').addClass('loading');--}}
{{--            } else {--}}
{{--                $('.cart-section').removeClass('loading');--}}
{{--            }--}}
{{--        }--}}

{{--        add_to_cart() {--}}
{{--            $('.btn-add-to-cart').on('click', function () {--}}
{{--                let btn = $(this)--}}
{{--                    , form = btn.closest('form')--}}
{{--                    , formData = form.serializeArray()--}}
{{--                    , action = form.attr('action');--}}

{{--                btn.prop('disabled', true);--}}

{{--                $.post(action, formData, function (response) {--}}
{{--                    $('.cart_count_item').text(response.count);--}}
{{--                    $('.number_notice').text(response.count);--}}
{{--                    $('.cart_message').text(response.message).addClass('show');--}}
{{--                    $("html, body").animate({scrollTop: 0}, "slow");--}}

{{--                    btn.prop('disabled', false);--}}
{{--                }, 'json');--}}
{{--            });--}}
{{--        }--}}

{{--        quantity_click() {--}}
{{--            let cart = this;--}}
{{--            $('.quantity .minus').on('click', function () {--}}
{{--                $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();--}}
{{--                cart.loading();--}}
{{--                cart.quantity_update();--}}
{{--            });--}}
{{--            $('.quantity .plus').on('click', function () {--}}
{{--                $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();--}}
{{--                cart.loading();--}}
{{--                cart.quantity_update();--}}

{{--            });--}}
{{--        }--}}

{{--        quantity_update() {--}}


{{--            let cart = this;--}}

{{--            let post_data = cart.cart_form.serializeArray();--}}
{{--            console.log(cart)--}}

{{--            $.post(cart.cart_update, post_data, function (response) {--}}

{{--                cart.loading(false);--}}
{{--            }, 'json').fail(function (response) {--}}

{{--                $.ajax({--}}
{{--                    url: 'https://demo.hoanglien.vn/update-qty',--}}
{{--                    method: 'get',--}}

{{--                    success: function (data) {--}}


{{--                        document.getElementById("change_price23").innerHTML = data;--}}
{{--                        document.getElementById("change_price231").innerHTML = data;--}}



{{--                    }        });--}}
{{--                cart.loading(false);--}}
{{--            });--}}
{{--        }--}}

{{--        checkout_click() {--}}
{{--            let cart = this;--}}
{{--            $('.btn_checkout').on('click', function () {--}}
{{--                let valid = cart.checkout_form.valid();--}}
{{--                if (!valid) {--}}
{{--                    return false;--}}
{{--                }--}}

{{--                cart.loading();--}}
{{--                let attributes = cart.checkout_form.serializeArray();--}}
{{--                cart.checkout(attributes);--}}
{{--            });--}}
{{--        }--}}

{{--        checkout(attributes) {--}}
{{--            let cart = this;--}}
{{--            $.post(cart.cart_checkout, attributes, function (response) {--}}
{{--                if ('customer' in response) {--}}
{{--                    cart.save_customer(response.customer);--}}
{{--                }--}}
{{--                if ('redirect' in response) {--}}
{{--                    window.location.href = response.redirect;--}}
{{--                }--}}
{{--                //console.log(response);--}}
{{--                cart.loading(false);--}}
{{--            }).fail(function (response) {--}}
{{--                if ('redirect' in response) {--}}
{{--                    window.location.href = response.redirect;--}}
{{--                }--}}
{{--                cart.loading(false);--}}
{{--            });--}}
{{--        }--}}

{{--        save_customer(attributes) {--}}
{{--            localStorage.setItem(this.customer_key, JSON.stringify(attributes));--}}
{{--        }--}}

{{--        load_customer() {--}}
{{--            let customer = localStorage.getItem(this.customer_key);--}}
{{--            if (!customer) {--}}
{{--                return false;--}}
{{--            }--}}
{{--            customer = JSON.parse(customer);--}}
{{--            //console.log(customer);--}}
{{--            $.each(customer, function (key, value) {--}}
{{--                $('.form-customer').find('input[name="' + key + '"]').val(value);--}}
{{--            });--}}
{{--        }--}}

{{--        validate_checkout_form() {--}}
{{--            //console.log(this.checkout_form);--}}
{{--            if (this.checkout_form.length > 0) {--}}
{{--                $.validator.addMethod("phoneStartWith0", function (phone_number, element){--}}
{{--                    phone_number = phone_number.replace(/\s+/g, "");--}}
{{--                    return this.optional(element) || phone_number.match(/^0\d{8,}$/);--}}
{{--                }, "Số điện thoại phải bắt đầu bằng số 0");--}}

{{--                $.validator.addClassRules("phone_field", {--}}
{{--                    required: true,--}}
{{--                    minlength: 9,--}}
{{--                    maxlength: 11,--}}
{{--                    number: true,--}}
{{--                    phoneStartWith0: true,--}}
{{--                });--}}

{{--                this.validate_message_vi();--}}
{{--                this.checkout_form.validate();--}}
{{--            }--}}
{{--        }--}}

{{--        validate_message_vi() {--}}
{{--            /*--}}
{{--             * Translated default messages for the jQuery validation plugin.--}}
{{--             * Locale: VI (Vietnamese; Tiếng Việt)--}}
{{--             */--}}
{{--            $.extend($.validator.messages, {--}}
{{--                required: "Vui lòng nhập thông tin.",--}}
{{--                remote: "Hãy sửa cho đúng.",--}}
{{--                email: "Hãy nhập email.",--}}
{{--                url: "Hãy nhập URL.",--}}
{{--                date: "Hãy nhập ngày.",--}}
{{--                dateISO: "Hãy nhập ngày (ISO).",--}}
{{--                number: "Hãy nhập số.",--}}
{{--                digits: "Hãy nhập chữ số.",--}}
{{--                creditcard: "Hãy nhập số thẻ tín dụng.",--}}
{{--                equalTo: "Hãy nhập thêm lần nữa.",--}}
{{--                extension: "Phần mở rộng không đúng.",--}}
{{--                maxlength: $.validator.format("Hãy nhập từ {0} kí tự trở xuống."),--}}
{{--                minlength: $.validator.format("Hãy nhập từ {0} kí tự trở lên."),--}}
{{--                rangelength: $.validator.format("Hãy nhập từ {0} đến {1} kí tự."),--}}
{{--                range: $.validator.format("Hãy nhập từ {0} đến {1}."),--}}
{{--                max: $.validator.format("Hãy nhập từ {0} trở xuống."),--}}
{{--                min: $.validator.format("Hãy nhập từ {0} trở lên.")--}}
{{--            });--}}
{{--        }--}}

{{--        checkbox_action() {--}}
{{--            $('input[data-another]').on('change', function () {--}}
{{--                let is_checked = $(this).is(':checked'), ele = $(this).data('another');--}}
{{--                if (is_checked) {--}}
{{--                    $(ele).show();--}}
{{--                } else {--}}
{{--                    $(ele).hide();--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    }--}}

{{--    (function ($) {--}}
{{--        //--}}
{{--        let cart = new LwmCart();--}}
{{--        cart.init();--}}
{{--        //--}}
{{--    })(jQuery);--}}

{{--    $('.choose-payment').click(function (){--}}
{{--        $('.show-payment').hide();--}}
{{--        $(this).closest('.wr-choose-payment').find('.show-payment').show();--}}
{{--    });--}}


{{--</script>--}}
