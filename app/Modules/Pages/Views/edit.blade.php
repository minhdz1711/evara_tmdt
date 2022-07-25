@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.pages.update',$page->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa trang</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên trang <b>*</b></label>
                                    <input type="text" name="title" value="{{ $page->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung <b>*</b></label>
                                    <textarea name="content" id="description"
                                              class="form-control @if($errors->has('content')) is-invalid @endif">{{ $page->content }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung mô tả</label>
                                    <textarea name="overview" class="form-control"
                                              rows="5">{{ $page->overview }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Giao diện</label>
                                    <select name="page_type" class="form-control">
                                        <option value="0" @if($page->page_type==0) selected @endif>Page Full Width</option>
                                        <option value="1" @if($page->page_type==1) selected @endif>Page Right Sidebar</option>
                                        <option value="2" @if($page->page_type==2) selected @endif>Page Left Sidebar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ ($page->images!="")?url($page->images):URL::asset('images/no_picture.gif') }}"/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại diện</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"
                                           style="{{ ($page->images!="")?'display:block':'' }}"><i
                                                class="fa fa-close"></i></a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    @include('admins.layouts.button-edit',['url'=>route('admin.pages.index'),'display'=>''])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
