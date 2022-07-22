
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
                    <h3 class="breadcrumb-title">Tất cả {!! $products->count() !!} sản phẩm {!! $search !!}</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="{{ route('index') }}">Trang chủ</a></li>
                                <li class="active" aria-current="page">kết quả tìm kiếm "{{$search}}"</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <h4 class="sidebar-title">Bài viết nổi bật</h4>
                <!-- Start Sidebar Area -->
                <div class="siderbar-section">
                    @foreach($posts as $post)
                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget">
                        <a href="{{ $post->slug }}.h" class="blog-feed-img-link">
                            <img src="{{ $post->images }}" alt="" class="blog-feed-img">
                        </a>
                        <div class="blog-feed-content">
                            <div class="blog-feed-post-meta">
                                <span>{{ date_format($post->created_at,'d/m/Y') }}</span>

                                <a href="" class="blog-feed-post-meta-date">{{ $post->ceated_at }}</a>
                            </div>
                            <h5 class="blog-feed-link"><a href="blog-single-sidebar-left.html">{{ substr($post->title,0,100) }}...</a></h5>
                        </div>
                    </div> <!-- End Single Sidebar Widget -->
                    @endforeach

                </div> <!-- End Sidebar Area -->
            </div>
            <div class="col-lg-9">

                <!-- Start Tab Wrapper -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content tab-animate-zoom">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                                        <div class="row">

                                                @foreach($products  as $product)
                                                    <div class="col-xl-4 col-sm-6 col-12">
                                                        <!-- Start Product Defautlt Single -->
                                                        <div class="product-default-single border-around">
                                                            <div class="product-img-warp">
                                                                <a href="product-details-default.html" class="product-default-img-link">
                                                                    <img src="{{ $product->images }}" alt="" class="product-default-img img-fluid">
                                                                </a>
                                                                <div class="product-action-icon-link">
                                                                    <ul>
                                                                        <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                                                        <li><a href="compare.html"><i class="icon-repeat"></i></a></li>
                                                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-eye"></i></a></li>
                                                                        <li><a href="#" data-toggle="modal" data-target="#modalAddcart"><i class="icon-shopping-cart"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="product-default-content">
                                                                <h6 class="product-default-link"><a href="product-details-default.html">{{ $product->title }}</a></h6>
                                                                <span class="product-default-price"> {{ number_format($product->regular_price) }} đ</span>
                                                            </div>
                                                        </div> <!-- End Product Defautlt Single -->
                                                    </div>
                                                @endforeach

                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <!-- Start List View Product -->
                                    <!-- End List View Product -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->

                <!-- Start Pagination -->
                <div class="page-pagination text-center">
                    <div class="pagination">{!! $products->links('pagination::bootstrap-4') !!}</div>
{{--                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">--}}
{{--                        {!! $products->appends(Request::only(['search']))->Links() !!}--}}
{{--                    </nav>--}}
                </div> <!-- End Pagination -->
            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->


<!-- Start Modal Add cart -->
<div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
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
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="modal-add-cart-product-img">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_1.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart successfully!</div>
                                    <div class="modal-add-cart-product-cart-buttons">
                                        <a href="cart.html">View Cart</a>
                                        <a href="checkout.html">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 modal-border">
                            <ul class="modal-add-cart-product-shipping-info">
                                <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your Cart.</strong></li>
                                <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                <li class="modal-continue-button"><a href="#" data-dismiss="modal">CONTINUE SHOPPING</a></li>
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
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_1.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_2.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_3.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_4.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_5.jpg" alt="">
                                    </div>
                                    <div class="product-image-large-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_6.jpg" alt="">
                                    </div>
                                </div>
                                <div class="product-image-thumb modal-product-image-thumb">
                                    <div class="zoom-active product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_1.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_2.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_3.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_4.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_5.jpg" alt="">
                                    </div>
                                    <div class="product-image-thumb-single">
                                        <img class="img-fluid" src="assets/images/products_images/aments_products_image_6.jpg" alt="">
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
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae</p>
                                </div> <!-- End  Product Details Text Area-->
                                <!-- Start Product Variable Area -->
                                <div class="product-details-variable">
                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item">
                                        <span>Color</span>
                                        <div class="product-variable-color">
                                            <label for="modal-product-color-red">
                                                <input name="modal-product-color" id="modal-product-color-red" class="color-select" type="radio" checked>
                                                <span class="product-color-red"></span>
                                            </label>
                                            <label for="modal-product-color-tomato">
                                                <input name="modal-product-color" id="modal-product-color-tomato" class="color-select" type="radio">
                                                <span class="product-color-tomato"></span>
                                            </label>
                                            <label for="modal-product-color-green">
                                                <input name="modal-product-color" id="modal-product-color-green" class="color-select" type="radio">
                                                <span class="product-color-green"></span>
                                            </label>
                                            <label for="modal-product-color-light-green">
                                                <input name="modal-product-color" id="modal-product-color-light-green" class="color-select" type="radio">
                                                <span class="product-color-light-green"></span>
                                            </label>
                                            <label for="modal-product-color-blue">
                                                <input name="modal-product-color" id="modal-product-color-blue" class="color-select" type="radio">
                                                <span class="product-color-blue"></span>
                                            </label>
                                            <label for="modal-product-color-light-blue">
                                                <input name="modal-product-color" id="modal-product-color-light-blue" class="color-select" type="radio">
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
                                        <li><a href="#" data-toggle="modal" data-target="#modalQuickview"><i class="icon-shopping-cart"></i>Add To Cart</a></li>
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
<script></script>
