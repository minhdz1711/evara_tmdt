<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-post" role="button"
       aria-expanded="false" aria-controls="tab-post">
        <i class="nav-icon fa-thumb-tack fa"></i> Bài viết
    </a>
    <div class="collapse" id="tab-post">
        <div class="card card-body">
            <div class="category-list post">
                @if(count($posts)>0)
                    <ul id="categorychecklist-post" class="categorychecklist form-no-clear">
                        @foreach($posts as $post)
                            <li id='popular-category-{{ $post->id }}' class='popular-category'>
                                <div class='custom-control custom-checkbox'>
                                    <input type='checkbox' class='custom-control-input'
                                           id='customCheck{{ $post->id }}-{{ $post->title }}'
                                           name='post_id[]'
                                           value='{{ $post->id }}'>
                                    <label class='custom-control-label'
                                           for='customCheck{{ $post->id }}-{{ $post->title }}'>{{ $post->title }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('admin.posts.index') }}"
                               style="font-size: 14px">Thêm bài viết mới</a>
                        </li>
                    </ul>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="post"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-post-->

<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-category" role="button"
       aria-expanded="false" aria-controls="tab-category">
        <i class="nav-icon fa-bars fa"></i> Danh mục bài viết
    </a>
    <div class="collapse" id="tab-category">
        <div class="card card-body">
            <div class="category-list post-category">
                @if(count($post_categories)>0)
                    <ul id="categorychecklist-category-post" class="categorychecklist form-no-clear">
                        {!! \App\Models\Config::showCheckCategories($post_categories,0,'',[],'category_post_id[]') !!}
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('admin.post-categories.index') }}"
                               style="font-size: 14px">Thêm danh mục</a>
                        </li>
                    </ul>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="post-category"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-category-->

<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-page" role="button"
       aria-expanded="false" aria-controls="tab-page">
        <i class="nav-icon fa-file fa"></i> Trang tĩnh
    </a>
    <div class="collapse" id="tab-page">
        <div class="card card-body">
            <div class="category-list page">
                @if(count($pages)>0)
                    <ul id="categorychecklist-post" class="categorychecklist form-no-clear">
                        @foreach($pages as $page)
                            <li id='popular-category-{{ $page->id }}' class='popular-category'>
                                <div class='custom-control custom-checkbox'>
                                    <input type='checkbox' class='custom-control-input'
                                           id='customCheck{{ $page->id }}-{{ $page->title }}'
                                           name='post_id[]'
                                           value='{{ $page->id }}'>
                                    <label class='custom-control-label'
                                           for='customCheck{{ $page->id }}-{{ $page->title }}'>{{ $page->title }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('admin.pages.index') }}"
                               style="font-size: 14px">Thêm trang mới</a>
                        </li>
                    </ul>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="page"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-page-->

<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-link" role="button"
       aria-expanded="false" aria-controls="tab-link">
        <i class="nav-icon fa-share fa"></i> Tự tạo đường dẫn
    </a>
    <div class="collapse" id="tab-link">
        <div class="card card-body">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tiêu đề" id="title_name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="https://" id="title_url">
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="link"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-link-->

<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-theme" role="button"
       aria-expanded="false" aria-controls="tab-theme">
        <i class="nav-icon fa fa-motorcycle"></i> Sản phẩm
    </a>
    <div class="collapse" id="tab-theme">
        <div class="card card-body">
            <div class="category-list product">
                @if(count($products)>0)
                    <ul id="categorychecklist-product" class="categorychecklist form-no-clear">
                        @foreach($products as $product)
                            <li id='popular-category-{{ $product->id }}' class='popular-category'>
                                <div class='custom-control custom-checkbox'>
                                    <input type='checkbox' class='custom-control-input'
                                           id='customCheck{{ $product->id }}-{{ $product->title }}'
                                           name='post_id[]'
                                           value='{{ $product->id }}'>
                                    <label class='custom-control-label'
                                           for='customCheck{{ $product->id }}-{{ $product->title }}'>{{ $product->title }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('admin.products.index') }}"
                               style="font-size: 14px">Thêm sản phẩm mới</a>
                        </li>
                    </ul>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="product"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-theme-->

<div class="item-menu">
    <a class="btn btn-default" data-toggle="collapse" href="#tab-theme-category"
       role="button" aria-expanded="false" aria-controls="tab-theme-category">
        <i class="nav-icon fa-bars fa"></i> Danh mục sản phẩm
    </a>
    <div class="collapse" id="tab-theme-category">
        <div class="card card-body">
            <div class="category-list product-category">
                @if(count($product_categories)>0)
                    <ul id="categorychecklist-product" class="categorychecklist form-no-clear">
                        {!! \App\Models\Config::showCheckCategories($product_categories,0,'',[],'category_product_id[]') !!}
                    </ul>
                @else
                    <ul>
                        <li><a href="{{ route('admin.product-categories.index') }}"
                               style="font-size: 14px">Thêm danh mục</a>
                        </li>
                    </ul>
                @endif
            </div>
            <button type="button" class="btn btn-sm btn-primary js_add_menu"
                    data-type="product-category"><i class="fa fa-plus-circle"></i> Thêm vào
                menu
            </button>
        </div>
    </div>
</div><!--tab-theme-category-->
