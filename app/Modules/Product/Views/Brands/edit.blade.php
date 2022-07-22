@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.brands.update',$category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa danh mục</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên thương hiệu <b>*</b></label>
                                    <input type="text" name="title" value="{{ $category->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Danh mục cha</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">--- Trống ---</option>
                                        {!! \App\Models\Config::showCategories($parents,0,'',$category->parent_id) !!}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Mô tả thương hiệu</label>
                                    <textarea name="overview" class="form-control"
                                              rows="4">{{ $category->overview }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ ($category->images!="")?url($category->images):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg"
                                               value="{{ $category->images }}"/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại diện</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            @include('admins.layouts.button-edit',['url'=>route('admin.brands.index'),'display'=>''])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
