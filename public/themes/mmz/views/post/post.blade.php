<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Bài viết</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/">Trang chủ</a></li>
                                <li class="active" aria-current="page">bài viết</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Category Section:::... -->
<div class="blog-section">
    <div class="container">
        <div class="row ">
            <div class="col-12">

                <div class="blog-full-width-wrapper">
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Start Category Grid Single -->
                            <div class="blog-feed-single">
                                <a href="{{ $post->slug }}.h" class="blog-feed-img-link">
                                    <img src="{{ $post->images }}" alt="" class="blog-feed-img">
                                </a>
                                <div class="blog-feed-content">
                                    <div class="blog-feed-post-meta">

                                        <a href="" class="blog-feed-post-meta-date">{{ date_format($post->created_at, 'd/m/Y') }}</a>
                                    </div>
                                    <h5 class="blog-feed-link"><a href="{{ $post->slug }}.h">{{ substr($post->title,0,125) }}</a></h5>
                                </div>
                            </div>
                            <!-- End Category Grid Single -->
                        </div>
                        @endforeach

                    </div>
                </div>

                <!-- Start Pagination -->
                <div class="page-pagination text-center">
                    <div class="pagination">{!! $posts->links('pagination::bootstrap-4') !!}</div>
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Category Section:::... -->
