@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.categories.update',$category->id) }}" method="POST">
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
                                    <label for="">Tên danh mục <b>*</b></label>
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
                                    <label for="">Mô tả danh mục</label>
                                    <textarea name="overview" class="form-control"
                                              rows="4">{{ $category->overview }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @include('admins.layouts.button-edit',['url'=>route('admin.categories.index'),'display'=>''])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
