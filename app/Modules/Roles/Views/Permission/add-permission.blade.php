@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.roles.postAdd',$role->id) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Cấp quyền cho {{ $role->display_name }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class='custom-control custom-checkbox'>
                                        <input type="checkbox"  class="custom-control-input"
                                               id="checkAll" onclick="toggle(this)">
                                        <label class='custom-control-label'
                                               for="checkAll">Chọn tất cả</label>
                                    </div>
                                </div>
                                @foreach($permissions as $key=>$permision)
                                    <label class="control-label">{{ $key }}</label>
                                    <div class="form-group">
                                        <div class="row">
                                            @foreach($permision as $value)
                                                <div class="col-6 col-md-4">
                                                    <div class='custom-control custom-checkbox'>
                                                        <input type="checkbox" name="permission[]"
                                                               @if(in_array($value->id, $rolePermissions)) checked
                                                               @endif class="custom-control-input check-permision"
                                                               id="customCheck-{{ $value->id }}"
                                                               value="{{ $value->id }}">
                                                        <label class='custom-control-label'
                                                               for="customCheck-{{ $value->id }}">{{ $value->display_name }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-danger"><i
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