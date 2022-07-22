
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
                <div
                    class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">{{ $product->title }}</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{ url('/') }}">Trang chủ</a></li>
                                @foreach($cate as $cat)
                                @foreach($cat->child as $key=>$item)
                                <li><a href="{{ $item->slug }}.htm">{{ $item->title }}</a></li>
                                @endforeach
                                @endforeach
                                <li class="active" aria-current="page">{{ $product->title }}</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- Start Product Details Section -->
<div class="product-details-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-details-gallery-area">
                    <div class="product-large-image product-large-image-horaizontal">
                        <div class="product-image-large-single zoom-image-hover">
                            <img src="{{ $product->images }}" alt="{{ $product->title }}">
                        </div>

                    </div>
                    <div class="product-image-thumb product-image-thumb-horizontal pos-relative">
{{--                        <div class="zoom-active product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_1.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
{{--                        <div class="product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_2.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
{{--                        <div class="product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_3.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
{{--                        <div class="product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_4.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
{{--                        <div class="product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_5.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
{{--                        <div class="product-image-thumb-single">--}}
{{--                            <img class="img-fluid" src="assets/images/products_images/aments_products_image_6.jpg"--}}
{{--                                alt="">--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details-content-area">
                    <!-- Start  Product Details Text Area-->
                    <div class="product-details-text">
                        <h4 class="title">{{ $product->title }}</h4>
{{--                    <h6 class="product-ref mb-20">Reference By: <span style="color: #0a0e14!important;">{!! \App\Models\Config::showAuthor($product->id_user) !!}</span></h6>--}}
                        <div class="d-flex align-items-center">
                            <div class="product-review">
                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                <span class="review-fill"><i class="fa fa-star"></i></span>
                                <span class="review-empty"><i class="fa fa-star"></i></span>
                            </div>
                            <a href="" class="customer-review">(customer review )</a>
                        </div>
                        <div class="variable-single-item">
                            <span>Giá bán :</span>
                            @if($product->sale_price==0)
                            <span class="price">{{ number_format($product->regular_price,0,'','.') }}&nbsp;đ</span>
                            @else
                            <div class="price">
                                <del>{{ number_format($product->regular_price,0,'','.') }}&nbsp;đ</del>{{ number_format($product->sale_price,0,'','.') }}&nbsp;đ
                            </div>
                            @endif
                        </div>
                        <div class="variable-single-item">
                            <span>Mô tả :</span>
                            <p>{{ $product->overview }}</p>
                        </div>

                    </div> <!-- End  Product Details Text Area-->
                    <!-- Start Product Variable Area -->
                    <div class="product-details-variable">

                        <!-- Product Attributes-->
                        <div class="variable-single-item">
                            <span>Thương hiệu : </span>
                            <div class="product-variable-color">
                                <span>{{ $brand->title }}</span>
                            </div>
                        </div>
                        <div class="variable-single-item">
                            <span>Danh mục : </span>
                            <div class="product-variable-color">
                                {!! \App\Models\Config::showCategoryProduct($product->id) !!}
                            </div>
                        </div>

                        <div class="variable-single-item">
                            <span>Trạng thái:</span>
                            @if($product->is_stock=0)
                            <span>( Đã hết hàng)</span>
                            @else
                            <span>( Còn hàng)</span>
                            @endif
                        </div>
                        <!-- End Product Attributes-->

                        <!-- Product Variable Single Item -->
                        <form method="post" action="{{ url('/add-cart') }}" >
                             @csrf

                            <div class="d-flex align-items-center">

                                    <div class="variable-single-item ">
                                        <span>Quantity</span>
                                        <div class="product-variable-quantity">
                                            <input min="1" max="{{ $product->quantity }}" name="qty" value="1"
                                                type="number">
                                        </div>
                                    </div>

                                    <input type="hidden" name="pro_id" value="{{ $product->id }}">
                                    <div class="product-add-to-cart-btn ">
                                        <button type="submit" class="btn btn-buy btn-add-to-cart "
                                            data-id="{{ $product->id }}" >
                                            Add to Cart
                                        </button>

                                    </div>
                            </div>
                        </form>

                    </div> <!-- End Product Variable Area -->
                    <!-- Start  Product Details Meta Area-->
                    <div class="product-details-meta mb-20">
                        <ul>
                            <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i
                                        class="icon-heart"></i>Add to wishlist</a></li>
                            <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                        </ul>
                    </div> <!-- End  Product Details Meta Area-->
                    <!-- Start  Product Details Social Area-->
                    <div class="product-details-social">
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i>Like</a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i>Tweet</a></li>
                            <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i>Save</a></li>
                            <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i>Save</a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i>Linked</a></li>
                        </ul>
                    </div> <!-- End  Product Details Social Area-->
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Details Section -->

<!-- Start Product Content Tab Section -->
<div class="product-details-content-tab-section section-inner-bg section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-content-tab-wrapper">

                    <!-- Start Product Details Tab Button -->
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li><a class="nav-link active" data-toggle="tab" href="#description">
                                <h5>Mô tả</h5>
                            </a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#specification">
                                <h5>Thông số</h5>
                            </a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#review">
                                <h5>Bình luận </h5>
                            </a></li>
                    </ul> <!-- End Product Details Tab Button -->

                    <!-- Start Product Details Tab Content -->
                    <div class="product-details-content-tab">
                        <div class="tab-content">
                            <!-- Start Product Details Tab Content Singel -->
                            <div class="tab-pane active show" id="description">
                                <div class="single-tab-content-item">
                                    {!! $product->content !!}
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                            <!-- Start Product Details Tab Content Singel -->
                            <div class="tab-pane" id="specification">
                                <div class="single-tab-content-item">
                                    <table class="table table-bordered mb-20">
                                        <tbody>
                                            @foreach($attribute as $attr)
                                            @foreach($attr->child as $key=>$item)
                                            <tr>
                                                <th scope="row">{{ $item->name }}</th>
                                                <td>{!! $item->product_attribute_value  !!}</td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                            <!-- Start Product Details Tab Content Singel -->
                            <div class="tab-pane" id="review">
                                <div class="single-tab-content-item">
                                    <!-- Start - Review Comment -->
                                    <form>
                                        @csrf
                                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $product->id }}">
                                    <ul class="comment" id="comment_show">

                                        <!-- Start - Review Comment list-->




                                            <!-- Start - Review Comment Reply-->
                                            <ul class="comment-reply">
                                                <li class="comment-reply-list">
                                                    <div class="comment-wrapper">
                                                        <div class="comment-img">
                                                            <img src="assets/images/user/image-2.png" alt="">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="comment-content-top">
                                                                <div class="comment-content-left">
                                                                    <h6 class="comment-name">Oaklee Odom</h6>
                                                                </div>
                                                                <div class="comment-content-right">
                                                                    <a href="#"><i class="fa fa-reply"></i>Reply</a>
                                                                </div>
                                                            </div>

                                                            <div class="para-content">
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing
                                                                    elit. Tempora inventore dolorem a unde modi iste
                                                                    odio amet, fugit fuga aliquam, voluptatem maiores
                                                                    animi dolor nulla magnam ea! Dignissimos aspernatur
                                                                    cumque nam quod sint provident modi alias culpa,
                                                                    inventore deserunt accusantium amet earum soluta
                                                                    consequatur quasi eum eius laboriosam, maiores
                                                                    praesentium explicabo enim dolores quaerat! Voluptas
                                                                    ad ullam quia odio sint sunt. Ipsam officia, saepe
                                                                    repellat. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul> <!-- End - Review Comment Reply-->
                                         <!-- End - Review Comment list-->

                                    </ul> <!-- End - Review Comment -->
                                    </form>
                                    <div class="review-form">
                                        <div class="review-form-text-top">
                                            <h5>Bình luận</h5>

                                        </div>

                                        <form class="comment_form">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="default-form-box mb-20">
                                                        <label for="comment-name">Họ tên <span>*</span></label>
                                                        <input id="comment-name" type="text"
                                                               class="comment_name"
                                                            placeholder="Nhập họ tên..." required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="default-form-box mb-20">
                                                        <label for="comment-review-text">Nhập bình luận
                                                            <span>*</span></label>
                                                        <textarea id="comment-review-text" name="content" class="comment_content" placeholder="Viết bình luận..."
                                                            required></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="form-submit-btn send-comment" type="submit">Gửi bình luận</button>
                                                </div>
                                            </div>
                                            <div id="notify_comment" class="col-lg-12"></div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                        </div>
                    </div> <!-- End Product Details Tab Content -->

                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Content Tab Section -->

<!-- ...:::: Start Product  Section:::... -->
<div class="product-section section-top-gap-100">
    <!-- Start Section Content -->
    <div class="section-content-gap">
        <div class="container">
            <div class="row">
                <div class="section-content">
                    <h3 class="section-title">Sản phẩm cùng loại</h3>
                </div>
            </div>
        </div>
    </div> <!-- End Section Content -->

    <!-- Start Product Wrapper -->
    <div class="product-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-default-slider product-default-slider-4grids-1row">
                        <!-- Start Product Defautlt Single -->
                        @foreach($relates as $relate)
                        <div class="product-default-single border-around">
                            <div class="product-img-warp">
                                <a href="{{ $relate->slug }}.html" class="product-default-img-link">
                                    <img src="{{ $relate->images }}" alt="" class="product-default-img img-fluid">
                                </a>
                                <div class="product-action-icon-link">
                                    <ul>
                                        <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                        <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i
                                                    class="icon-eye"></i></a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i
                                                    class="icon-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-default-content">
                                <h6 class="product-default-link"><a
                                        href="product-details-default.html">{{ $relate->title }}</a></h6>
                                @if($relate->sale_price==0)
                                <span
                                    class="product-default-price">{{ number_format($relate->regular_price) }}&nbsp;đ</span>
                                @else
                                <span class="product-default-price"><del
                                        class="product-default-price-off">{{ number_format($relate->regular_price) }}đ</del>
                                    {{ number_format($relate->sale_price) }}&nbsp;đ</span>
                                @endif
                            </div>
                        </div> <!-- End Product Defautlt Single -->
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Wrapper -->
</div> <!-- ...:::: End Product Section:::... -->

{{--<!-- ...:::: Start Product Section:::... -->--}}
{{--<div class="product-section section-top-gap-100">--}}
{{--    <!-- Start Section Content -->--}}
{{--    <div class="section-content-gap">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="section-content">--}}
{{--                    <h3 class="section-title">Sản phẩm đã xem</h3>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- End Section Content -->--}}

{{--    <!-- Start Product Wrapper -->--}}
{{--    <div class="product-wrapper">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="product-default-slider product-default-slider-4grids-1row">--}}
{{--                        <!-- Start Product Defautlt Single -->--}}
{{--                       --}}
{{--                        <div class="product-default-single border-around">--}}
{{--                            <div class="product-img-warp">--}}
{{--                                <a href="product-details-default.html" class="product-default-img-link">--}}
{{--                                    <img src="" alt=""--}}
{{--                                        class="product-default-img img-fluid">--}}
{{--                                </a>--}}
{{--                                <div class="product-action-icon-link">--}}
{{--                                    <ul>--}}
{{--                                        <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>--}}
{{--                                        <li><a href="compare.html"><i class="icon-repeat"></i></a></li>--}}
{{--                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i--}}
{{--                                                    class="icon-eye"></i></a></li>--}}
{{--                                        <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i--}}
{{--                                                    class="icon-shopping-cart"></i></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="product-default-content">--}}
{{--                                <h6 class="product-default-link"><a href="product-details-default.html">New Balance--}}
{{--                                        Fresh Foam Kaymin Car Purts</a></h6>--}}
{{--                                <span class="product-default-price"><del class="product-default-price-off">$30.12</del>--}}
{{--                                    $25.12</span>--}}
{{--                            </div>--}}
{{--                        </div> <!-- End Product Defautlt Single -->--}}
{{--                        <!-- Start Product Defautlt Single -->--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div> <!-- End product Wrapper -->--}}
{{--</div> <!-- ...:::: End Product Section:::... -->--}}

<!-- material-scrolltop button -->
<button class="material-scrolltop" type="button"></button>

<!-- Start Modal Add cart -->
<div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col ">
                            <div class="modal-add-cart-info">
                                <i class="fa fa-check-square"></i>
                                Added to cart successfully!
                            </div>
                            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close"
                                style="z-index: 9;position:absolute;top: -2px;right: 25px">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row modal-content-add-cart">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="modal-add-cart-product-img">
                                        <img class="img-fluid" src="{{ $product->images }}" alt="">
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="modal-add-cart-product-title">
                                        <a href="{{ $product->slug }}.html">
                                            {{ $product->title }} ( @foreach($attribute as $attr)
                                            @foreach($attr->child as $key=>$item)
                                            {{ $item->name }} : {!! $item->product_attribute_value !!},
                                            @endforeach
                                            @endforeach  )
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-12">

                                    <div class="modal-add-cart-product-cart-buttons">
                                        <a href="{{ url('/cart') }}">View Cart</a>
                                        <a href="checkout.html">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 modal-border">
                            <ul class="modal-add-cart-product-shipping-info">
                                <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</strong>
                                </li>
                                <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                <li class="modal-continue-button"><a class="btn btn-outline-primary"
                                        href="{{ url('/') }}">CONTINUE SHOPPING</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Add cart -->

<!-- Start Modal Quickview cart -->
<div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-details-gallery-area">
                                <div class="product-large-image modal-product-image-large">
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_1.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_2.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_3.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_4.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_5.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_6.jpg" alt="">
                                    </div>
                                </div>
                                <div class="product-image-thumb modal-product-image-thumb">
                                    <div class="zoom-active product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_1.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_2.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_3.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_4.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_5.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid"
                                            src="assets/images/products_images/aments_products_image_6.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product-details-content-area">
                                <!-- Start  Product Details Text Area-->
                                <div class="product-details-text">
                                    <h4 class="title">Nonstick Dishwasher PFOA</h4>
                                    <div class="price"><del>$70.00</del>$80.00</div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum
                                        ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui
                                        nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae</p>
                                </div> <!-- End  Product Details Text Area-->
                                <!-- Start Product Variable Area -->
                                <div class="product-details-variable">
                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item">
                                        <span>Color</span>
                                        <div class="product-variable-color">
                                            <label for="modal-product-color-red">
                                                <input name="modal-product-color" id="modal-product-color-red"
                                                    class="color-select" type="radio" checked>
                                                <span class="product-color-red"></span>
                                            </label>
                                            <label for="modal-product-color-tomato">
                                                <input name="modal-product-color" id="modal-product-color-tomato"
                                                    class="color-select" type="radio">
                                                <span class="product-color-tomato"></span>
                                            </label>
                                            <label for="modal-product-color-green">
                                                <input name="modal-product-color" id="modal-product-color-green"
                                                    class="color-select" type="radio">
                                                <span class="product-color-green"></span>
                                            </label>
                                            <label for="modal-product-color-light-green">
                                                <input name="modal-product-color" id="modal-product-color-light-green"
                                                    class="color-select" type="radio">
                                                <span class="product-color-light-green"></span>
                                            </label>
                                            <label for="modal-product-color-blue">
                                                <input name="modal-product-color" id="modal-product-color-blue"
                                                    class="color-select" type="radio">
                                                <span class="product-color-blue"></span>
                                            </label>
                                            <label for="modal-product-color-light-blue">
                                                <input name="modal-product-color" id="modal-product-color-light-blue"
                                                    class="color-select" type="radio">
                                                <span class="product-color-light-blue"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item ">
                                        <span>Quantity</span>
                                        <div class="product-variable-quantity">
                                            <input min="1" max="100" value="1" type="number">
                                        </div>
                                    </div>
                                </div> <!-- End Product Variable Area -->
                                <!-- Start  Product Details Meta Area-->
                                <div class="product-details-meta mb-20">
                                    <ul>
                                        <li><a href=""><i class="icon-heart"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="icon-repeat"></i>Compare</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i
                                                    class="icon-shopping-cart"></i>Add To Cart</a></li>
                                    </ul>
                                </div> <!-- End  Product Details Meta Area-->
                                <!-- Start  Product Details Social Area-->
                                <ul class="modal-product-details-social">
                                    <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                </ul> <!-- End  Product Details Social Area-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Quickview cart -->




