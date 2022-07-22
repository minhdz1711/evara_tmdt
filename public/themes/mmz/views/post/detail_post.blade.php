<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between justify-content-md-between  align-items-center flex-md-row flex-column">
                    <h3 class="breadcrumb-title">Chi tiết bài viết</h3>
                    <div class="breadcrumb-nav">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="/">Trang chủ</a></li>
                                <li><a href="{{ route('Post.viewPosts') }}">Bài viết</a></li>
                                <li class="active" aria-current="page">Chi tiết</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Category Single Section:::... -->
<div class="blog-single-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-8 offset-2">
                <!-- Start Category Single Content Area -->
                <div class="blog-single-wrapper">
                    <div class="blog-single-img">
                        <img class="img-fluid" src="{{ $post->images }}" alt="">
                    </div>
                    <div class="blog-feed-post-meta">
                        <a href="" class="blog-feed-post-meta-date">{{ date_format($post->created_at,'d/m/Y') }}</a>
                    </div>
                    <h4 class="post-title">{{ $post->title }}</h4>
                    <div class="para-content">
                        {!! $post->content !!}
                    </div>
{{--                    <div class="para-tags">--}}
{{--                        <span>Tags: </span>--}}
{{--                        <ul>--}}
{{--                            <li><a href="">fashion</a></li>--}}
{{--                            <li><a href="">t-shirt</a></li>--}}
{{--                            <li><a href="">white</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div> <!-- End Category Single Content Area -->
{{--                <div class="comment-area">--}}
{{--                    <h4 class="mb-30">3 Comments</h4>--}}
{{--                    <!-- Start - Review Comment -->--}}
{{--                    <ul class="comment">--}}
{{--                        <!-- Start - Review Comment list-->--}}
{{--                        <li class="comment-list">--}}
{{--                            <div class="comment-wrapper">--}}
{{--                                <div class="comment-img">--}}
{{--                                    <img src="assets/images/user/image-1.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="comment-content">--}}
{{--                                    <div class="comment-content-top">--}}
{{--                                        <div class="comment-content-left">--}}
{{--                                            <h6 class="comment-name">Kaedyn Fraser</h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="comment-content-right">--}}
{{--                                            <a href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="para-content">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- Start - Review Comment Reply-->--}}
{{--                            <ul class="comment-reply">--}}
{{--                                <li class="comment-reply-list">--}}
{{--                                    <div class="comment-wrapper">--}}
{{--                                        <div class="comment-img">--}}
{{--                                            <img src="assets/images/user/image-2.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="comment-content">--}}
{{--                                            <div class="comment-content-top">--}}
{{--                                                <div class="comment-content-left">--}}
{{--                                                    <h6 class="comment-name">Oaklee Odom</h6>--}}
{{--                                                </div>--}}
{{--                                                <div class="comment-content-right">--}}
{{--                                                    <a href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="para-content">--}}
{{--                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul> <!-- End - Review Comment Reply-->--}}
{{--                        </li> <!-- End - Review Comment list-->--}}
{{--                        <!-- Start - Review Comment list-->--}}
{{--                        <li class="comment-list">--}}
{{--                            <div class="comment-wrapper">--}}
{{--                                <div class="comment-img">--}}
{{--                                    <img src="assets/images/user/image-3.png" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="comment-content">--}}
{{--                                    <div class="comment-content-top">--}}
{{--                                        <div class="comment-content-left">--}}
{{--                                            <h6 class="comment-name">Jaydin Jones</h6>--}}
{{--                                        </div>--}}
{{--                                        <div class="comment-content-right">--}}
{{--                                            <a href="#"><i class="fa fa-reply"></i>Reply</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <div class="para-content">--}}
{{--                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </li> <!-- End - Review Comment list-->--}}
{{--                    </ul> <!-- End - Review Comment -->--}}

{{--                    <!-- Start comment Form -->--}}
{{--                    <div class="comment-form">--}}
{{--                        <div class="coment-form-text-top mt-30">--}}
{{--                            <h4>Leave a Reply</h4>--}}
{{--                            <p>Your email address will not be published. Required fields are marked *</p>--}}
{{--                        </div>--}}

{{--                        <form action="#" method="post">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="default-form-box mb-20">--}}
{{--                                        <label for="comment-name">Your name <span>*</span></label>--}}
{{--                                        <input id="comment-name" type="text" placeholder="Enter your name" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <div class="default-form-box mb-20">--}}
{{--                                        <label for="comment-email">Your Email <span>*</span></label>--}}
{{--                                        <input id="comment-email" type="email" placeholder="Enter your email" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12">--}}
{{--                                    <div class="default-form-box mb-20">--}}
{{--                                        <label for="comment-review-text">Your review <span>*</span></label>--}}
{{--                                        <textarea id="comment-review-text" placeholder="Write a review" required></textarea>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-12">--}}
{{--                                    <button class="form-submit-btn" type="submit">Post Comment</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div> <!-- End comment Form -->--}}
{{--                </div>--}}


            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Category Single Section:::... -->
