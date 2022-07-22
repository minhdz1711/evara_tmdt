<!-- ...:::: Start Offcanvas Mobile Menu Section:::... -->
<section id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="fa fa-times"></i></button>
    </div> <!-- ENd Offcanvas Header -->

    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_6.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Car Wheel</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/categories_images/aments_categories_08.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Car Vails</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="" class="offcanvas-wishlist-item-image-link">
                        <img src="assets/images/products_images/aments_products_image_2.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            <li class="offcanvas-wishlist-action-button-list"><a href="" class="offcanvas-wishlist-action-button-link">View wishlist</a></li>
        </ul>
    </div> <!-- End Offcanvas Mobile Menu Wrapper -->

</section> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->
<div class="offcanvas-overlay"></div>
<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Thanh toán</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{route('index')}}">Trang chủ</a></li>
                                <li class="active" aria-current="page">Thanh toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Checkout Section:::... -->
<div class="checkout_section">
    <div class="container">
        <div class="row">
            <!-- User Quick Action Form -->
            <?php
            $member_id=Session::get('member_id');
            if($member_id!=null){  ?>
            <p></p>
            <?php

            }
            else{
            ?>
            <div class="col-12">
                <div class="user-actions accordion">
                    <h3>
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                        Returning customer?
                        <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>
                    </h3>
                    <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                        <div class="checkout_info">
                            <form action="{{ route('loginCheckout') }}" method="get">
                                @csrf
                                <div class="form_group default-form-box">
                                    <label>Email <span>*</span></label>
                                    <input type="text" name="email_member">
                                </div>
                                <div class="form_group default-form-box">
                                    <label>Mật khẩu <span>*</span></label>
                                    <input type="password" name="pass_member">
                                </div>
                                <div class="form_group group_3 default-form-box">
                                    <button type="submit">submit</button>
                                    <label class="checkbox-default">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>

                                @error('error')
                                <p>{{ $error }}</p>
                                @enderror
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        <?php

        }
        ?>
            <!-- User Quick Action Form -->
        </div>
        <!-- Start User Details Checkout Form -->
        <div class="checkout_form">
            <form action="{{ route('orderPlace') }}" method="post">
                @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">

                        <h3>Chi tiết hóa đơn</h3>

                        <div class="row">
                            <?php
                            $member_id=Session::get('member_id');
                            if($member_id!=null ){
                            $member_ship=App\Modules\Membership\Models\Membership::where('id',$member_id)->first();
                            ?>
                                <div class="col-lg-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Họ và tên <span>*</span></label>
                                        <input type="text" value="{{ $member_ship->display_name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label>Tên đăng nhập</label>
                                        <input type="text" value="{{ $member_ship->username }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label>Số điện thoại<span>*</span></label>
                                        <input type="text" value="{{ $member_ship->phone }}" disabled>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-20">
                                    <div class="default-form-box">
                                        <label> Email  <span>*</span></label>
                                        <input type="email" value="{{ $member_ship->email }}" disabled>
                                    </div>
                                </div>
                                <div class="col-12 mb-20">
                                    <div class="default-form-box">
                                        <label for="">Địa chỉ <span>*</span></label>
                                        <input placeholder="đường,số nhà,(thôn/làng), xã, (quận/huyện), (tỉnh/thành phố)..." type="text" value="{{ $member_ship->address }}" disabled>
                                    </div>
                                </div>
                            <?php

                            }
                            else{
                                ?>
{{--                            <form action="route('addMember')" method="post">--}}
{{--                                @csrf--}}
                            <div class="col-lg-12 mb-20">
                                <div class="default-form-box">
                                    <label>Họ và tên <span>*</span></label>
                                    <input type="text" name="display_name">
                                </div>
                            </div>

                            <div class="col-12 mb-20">
                                <div class="default-form-box">
                                    <label>Tên đăng nhập</label>
                                    <input type="text" name="username" required>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="default-form-box">
                                    <label>Số điện thoại<span>*</span></label>
                                    <input type="text" name="phone" required maxlength="10" minlength="10">
                                </div>
                            </div>
                            <div class="col-lg-6 mb-20">
                                <div class="default-form-box">
                                    <label> Email  <span>*</span></label>
                                    <input type="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-12 mb-20">
                                <div class="default-form-box">
                                    <label for="">Địa chỉ <span>*</span></label>
                                    <input placeholder="đường,số nhà,(thôn/làng), xã, (quận/huyện), (tỉnh/thành phố)..." type="text" name="address" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="checkbox-default" for="newAccount" data-toggle="collapse" data-target="#newAccountPassword">
                                    <input type="checkbox" id="newAccount">
                                    <span>Tạo tài khoản?</span>
                                </label>
                                <div id="newAccountPassword" class="collapse" data-parent="#newAccountPassword">
                                    <div class="card-body1 default-form-box">
                                        <label> Mật khẩu <span>*</span></label>
                                        <input placeholder="password" type="password" name="pass" required>
                                    </div>
                                </div>
                            </div>
{{--                            </form>--}}
                                <?php

                                }
                                ?>
                            <div class="col-12 mb-20">
                                <label class="checkbox-default" for="newShipping" data-toggle="collapse" data-target="#anotherShipping">
                                    <input type="checkbox" id="newShipping">
                                    <span>Giao hàng đến địa chỉ khác?</span>
                                </label>

                                <div id="anotherShipping" class="collapse" data-parent="#anotherShipping">
                                    <div class="row">
{{--                                        <form action="{{ route('saveShipping') }}" method="post">--}}
{{--                                            @csrf--}}
                                        <div class="col-lg-12 mb-20">
                                            <div class="default-form-box">
                                                <label>Họ và tên <span>*</span></label>
                                                <input type="text" name="ship_name">
                                            </div>
                                        </div>
                                        <div class="col-12 mb-20">
                                            <div class="default-form-box">
                                                <label>Địa chỉ</label>
                                                <input type="text" name="ship_address">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-20">
                                            <div class="default-form-box">
                                                <label>Số điện thoại<span>*</span></label>
                                                <input type="text" name="ship_phone">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-20">
                                            <div class="default-form-box">
                                                <label> Email  <span>*</span></label>
                                                <input type="email" name="ship_email">
                                            </div>
                                        </div>
{{--                                        </form>--}}

                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="order-notes">
                                    <label for="order_note">Ghi chú đơn hàng</label>
                                    <textarea id="order_note" placeholder="Ghi chú về đơn hàng của bạn..." name="order_notes"></textarea>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="col-lg-6 col-md-6">
                    <form >

                        <h3>Đơn hàng của bạn</h3>
                        <div class="order_table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(Cart::content() as $item)
                                <tr>
                                    <td><img style="height: auto;width: 80px" src="{{ $item->options->images }}"> &nbsp;&nbsp;{{ $item->name }} <strong> × {{ $item->qty }}</strong></td>
                                    <td> {{ number_format($item->price) }} đ</td>
                                </tr>
                                @endforeach
                                <tr class="order_total">
                                    <th>Tổng tiền đơn hàng</th>
                                    <td><strong>{{ Cart::subtotal() }} đ</strong></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment_method">
                            <div class="panel-default">
                                @foreach($payment as $pay)
                                <label class="checkbox-default" for="currencyCod" >
                                    <input type="checkbox"  name="payment_method" value="{{ $pay->id }}">
                                    <span>{{ $pay->method }}</span>
                                </label>
                                @endforeach

{{--                                <div id="methodCod" class="collapse" data-parent="#methodCod">--}}
{{--                                    <div class="card-body1">--}}
{{--                                        <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <div class="order_button pt-15">
                                <button type="submit">Đặt hàng</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </form>
        </div> <!-- Start User Details Checkout Form -->
    </div>
</div><!-- ...:::: End Checkout Section:::... -->

<!-- ...:::: Start Footer Section:::... -->


<!-- material-scrolltop button -->
<button class="material-scrolltop" type="button"></button>

<style>
    .choose-link{
        background: none;
        color: #333;
        display: inline-block;
        vertical-align: middle;
        padding: 10px 20px 10px 0;
        position: relative;
        cursor: pointer;
    }
</style>
