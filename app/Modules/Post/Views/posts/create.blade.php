@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.posts.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm bài viết mới</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên bài viết <b>*</b></label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung <b>*</b></label>
                                    <textarea name="content" id="description"
                                              class="form-control @if($errors->has('content')) is-invalid @endif">{{ old('content') }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung mô tả</label>
                                    <textarea name="overview" class="form-control"
                                              rows="5">{{ old('overview') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Danh mục bài viết</label>
                                    <div class="category-list">
                                        @if(count($post_categories)>0)
                                            <ul id="categorychecklist-pop" class="categorychecklist form-no-clear">
                                                {!! \App\Models\Config::showCheckCategories($post_categories,0,'',[],'post_category_id[]') !!}
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('admin.post-categories.index') }}" style="font-size: 14px">Thêm danh mục</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Danh mục sản phẩm</label>
                                    <div class="category-list">
                                        @if(count($product_categories)>0)
                                            <ul id="categorychecklist-pop" class="categorychecklist form-no-clear">
                                                {!! \App\Models\Config::showCheckCategories($product_categories,0,'',[],'product_category_id[]') !!}
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('admin.product-categories.index') }}" style="font-size: 14px">Thêm danh mục</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="">Loại thẻ</label>--}}
{{--                                    <div class="category-list">--}}
{{--                                        @if(count($tags)>0)--}}
{{--                                            <ul id="categorychecklist-pop" class="categorychecklist form-no-clear">--}}
{{--                                                {!! \App\Models\Config::showCheckTags($tags,0,'',[],'tag_id[]') !!}--}}
{{--                                            </ul>--}}
{{--                                        @else--}}
{{--                                            <ul>--}}
{{--                                                <li><a href="{{ route('admin.tags.create') }}" style="font-size: 14px">Thêm danh mục</a>--}}
{{--                                                </li>--}}
{{--                                            </ul>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ (old('images')!="")?old('images'):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg" value=""/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại diện</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                    class="fa fa-close"></i></a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    @include('admins.layouts.button-add',['url'=>route('admin.posts.index'),'display'=>''])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
