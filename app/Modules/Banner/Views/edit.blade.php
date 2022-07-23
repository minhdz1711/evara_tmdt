@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.banners.update',$banner->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa banner</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên banner <b>*</b></label>
                                    <input type="text" name="title" value="{{ $banner->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Đường dẫn banner</label>
                                    <input type="text" name="link_banner" value="{{ $banner->link_banner }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Vị trí banner</label>
                                    <select name="position" class="form-control">
                                        <option value="1" @if($banner->position==1) selected @endif>Header</option>
                                        <option value="2" @if($banner->position==2) selected @endif>Footer</option>
                                        <option value="3" @if($banner->position==3) selected @endif>Quảng cáo</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Sort</label>
                                    <input type="number" name="order" value="{{ $banner->order }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ ($banner->images!="")?url($banner->images):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg" value="{{ $banner->images }}"/>
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
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection