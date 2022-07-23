@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm tài khoản mới</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên hiển thị <b>*</b></label>
                                    <input type="text" name="display_name"
                                           class="form-control @if($errors->has('display_name')) is-invalid @endif"
                                           value="{{ old('display_name') }}">
                                    @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Username <b>*</b></label>
                                    <input type="text" name="username"
                                           class="form-control @if($errors->has('username')) is-invalid @endif"
                                           value="{{ old('username') }}">
                                    @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Email <b>*</b></label>
                                    <input type="email" name="email"
                                           class="form-control @if($errors->has('email')) is-invalid @endif"
                                           value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Mật khẩu <b>*</b></label>
                                    <input type="password" name="password"
                                           class="form-control @if($errors->has('password')) is-invalid @endif"
                                           value="{{ old('password') }}">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại <b>*</b></label>
                                    <input type="text" name="phone"
                                           class="form-control @if($errors->has('phone')) is-invalid @endif"
                                           value="{{ old('display_name') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Giới tính</label><br>
                                   <div class="row">
                                       <div class="col-6 col-md-2">
                                           <div class="custom-control custom-radio">
                                               <input class="custom-control-input" type="radio" id="customRadio1" name="gender" checked="" value="0">
                                               <label for="customRadio1" class="custom-control-label">Nam</label>
                                           </div>
                                       </div>
                                       <div class="col-6 col-md-2">
                                           <div class="custom-control custom-radio">
                                               <input class="custom-control-input" type="radio" id="customRadio2" name="gender" value="1">
                                               <label for="customRadio2" class="custom-control-label">Nữ</label>
                                           </div>
                                       </div>
                                   </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Quyền hạn <b>*</b></label>
                                    <select name="position" class="form-control">
                                        <option value="0">--- Trống ---</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                            </div>
                        </div>
                        <div class="form-group">
                            @include('admins.layouts.button-add',['url'=>route('admin.users.index'),'display'=>''])
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
