@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.banners.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm banner ảnh mới</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên banner <b>*</b></label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Đường dẫn banner</label>
                                    <input type="text" name="link_banner" value="{{ old('link_banner') }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Vị trí banner</label>
                                    <select name="position" class="form-control">
                                        <option value="1">Header</option>
                                        <option value="2">Footer</option>
                                        <option value="3">Quảng cáo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sort</label>
                                    <input type="number" name="order" value="{{ old('order') }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ (old('images')!="")?old('images'):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg" value=""/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm hình ảnh</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                    class="fa fa-close"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-danger"><i
                                        class="fa fa-reply"></i> Trở lại</a>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Thêm mới
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection