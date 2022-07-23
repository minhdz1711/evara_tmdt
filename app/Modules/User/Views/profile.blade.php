@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle avatar-profile"
                                     src="{{ (\Auth::user()->images!="")?url(\Auth::user()->images):asset('/assets/dist/img/user2-160x160.jpg') }}"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ (\Auth::user()->display_name!="")?\Auth::user()->display_name:\Auth::user()->username }}</h3>
                            <p class="text-muted text-center">{!! \App\Models\Config::showRoles(\Auth::user()->id) !!}</p>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Bài viết đã đăng</b> <a class="float-right"><span
                                                class="badge badge-primary right">0</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Trang đã đăng</b> <a class="float-right"><span class="badge badge-success right">0</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Xe đã đăng</b> <a class="float-right"><span
                                                class="badge badge-danger right">0</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Video đã đăng</b> <a class="float-right"><span class="badge badge-warning right">0</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Giá xe đã đăng</b> <a class="float-right"><span
                                                class="badge badge-dark right">0</span></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Đánh giá đã đăng</b> <a class="float-right"><span class="badge badge-info right">0</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Thông
                                        tin tài khoản</a></li>
                                <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Đổi mật
                                        khẩu</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="information">
                                    <form action="{{ route('admin.profile.update',\Auth::user()->id) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-md-8">
                                                <div class="form-group">
                                                    <label for="">Tên hiển thị <b>*</b></label>
                                                    <input type="text"
                                                           class="form-control @if($errors->has('display_name')) is-invalid @endif"
                                                           name="display_name"
                                                           value="{{ \Auth::user()->display_name }}">
                                                    @error('display_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Username <b>*</b></label>
                                                    <input type="text" name="username"
                                                           class="form-control @if($errors->has('username')) is-invalid @endif"
                                                           value="{{ \Auth::user()->username }}">
                                                    @error('username')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email <b>*</b></label>
                                                    <input type="email" name="email"
                                                           class="form-control"
                                                           value="{{ \Auth::user()->email }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Số điện thoại <b>*</b></label>
                                                    <input type="text" name="phone"
                                                           class="form-control @if($errors->has('phone')) is-invalid @endif"
                                                           value="{{ \Auth::user()->phone }}">
                                                    @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Giới tính</label><br>
                                                    <div class="row">
                                                        <div class="col-6 col-md-2">
                                                            <div class="custom-control custom-radio">
                                                                <input class="custom-control-input" type="radio"
                                                                       id="customRadio1" name="gender"
                                                                       @if(\Auth::user()->gender==0) checked=""
                                                                       @endif value="0">
                                                                <label for="customRadio1" class="custom-control-label">Nam</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-2">
                                                            <div class="custom-control custom-radio">
                                                                <input class="custom-control-input" type="radio"
                                                                       id="customRadio2" name="gender"
                                                                       @if(\Auth::user()->gender==1) checked=""
                                                                       @endif value="1">
                                                                <label for="customRadio2" class="custom-control-label">Nữ</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <label for="">Avatar</label>
                                                    <div class="previewThumbnail" style="width: 200px">
                                                        <img id="logo-icon" class="imgPreview"
                                                             src="{{ (\Auth::user()->images!="")?url(\Auth::user()->images):URL::asset('images/no_picture.gif') }}"/>
                                                        <input type="hidden" name="images" id="image" class="inputImg"
                                                               value="{{ \Auth::user()->images }}"/>
                                                        <a href="javascript:void(0)"
                                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm
                                                            ảnh đại diện</a>
                                                        <a href="javascript:void(0);"
                                                           class="btn btn-outline-danger btn-sm btn-close"
                                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                                    class="fa fa-close"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-12">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                                class="fa fa-save"></i> Cập nhật thông tin
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div><!--information-->
                                <div class="tab-pane" id="password">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <form action="{{ route('admin.profile.password',\Auth::user()->id) }}"
                                                  method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">Nhập mật khẩu hiện tại <b>*</b></label>
                                                    <input type="password"
                                                           class="form-control @if($errors->has('password_current')) is-invalid @endif"
                                                           name="password_current">
                                                    @error('password_current')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Nhập mật mới <b>*</b></label>
                                                    <input type="password"
                                                           class="form-control @if($errors->has('pw_1')) is-invalid @endif"
                                                           name="pw_1">
                                                    @error('pw_1')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Nhập lại mật khẩu <b>*</b></label>
                                                    <input type="password"
                                                           class="form-control @if($errors->has('pw_2')) is-invalid @endif"
                                                           name="pw_2">
                                                    @error('pw_2')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-sm btn-success"><i
                                                                class="fa fa-save"></i> Đổi mật khẩu
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div><!--password-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection