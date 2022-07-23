@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.posts.update',$post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa bài viết</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên bài viết <b>*</b></label>
                                    <input type="text" name="title" value="{{ $post->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung <b>*</b></label>
                                    <textarea name="content" id="description"
                                              class="form-control @if($errors->has('content')) is-invalid @endif">{!! $post->content !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung mô tả</label>
                                    <textarea name="overview" class="form-control"
                                              rows="5">{{ $post->overview }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Danh mục</label>
                                    <div class="category-list">
                                        @if(count($post_categories)>0)
                                            <ul id="categorychecklist-pop" class="categorychecklist form-no-clear">
                                                {!! \App\Models\Config::showCheckCategories($post_categories,0,'',$arg_id,'post_category_id[]') !!}
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('admin.categories.index') }}"
                                                       style="font-size: 14px">Thêm danh mục</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ ($post->images!="")?url($post->images):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg"
                                               value="{{ $post->images }}"/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại diện</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"
                                           style="{{ ($post->images!="")?'display:block':'' }}"><i
                                                class="fa fa-close"></i></a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    @include('admins.layouts.button-edit',['url'=>route('admin.posts.index'),'display'=>''])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
