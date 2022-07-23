@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.roles.update',$role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa danh mục đánh giá</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên nhóm phân quyền <b>*</b></label>
                                    <input type="text" name="display_name" value="{{ $role->display_name }}"
                                           class="form-control @if($errors->has('display_name')) is-invalid @endif">
                                    @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    @include('admins.layouts.button-edit',['url'=>route('admin.roles.index'),'display'=>''])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
