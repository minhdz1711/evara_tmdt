@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.post-categories.update',$category->id) }}" method="POST">
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thông tin Seo</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tiêu đề</label>
                                    <input type="text" name="seo_title"
                                           value="{{ ($category->seo_title!="")?$category->seo_title:old('seo_title') }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Từ khoá</label>
                                    <input type="text" name="seo_keyword"
                                           value="{{ ($category->seo_keyword!="")?$category->seo_keyword:old('seo_keyword') }}"
                                           class="form-control" placeholder="Từ khoá 1, Từ khoá 2,...">
                                </div>
                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea name="seo_description" class="form-control"
                                              rows="4">{{ ($category->seo_description!="")?$category->seo_description:old('seo_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            @include('admins.layouts.button-edit',['url'=>route('admin.post-categories.index'),'display'=>''])
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
