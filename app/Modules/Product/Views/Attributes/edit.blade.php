@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.product-attributes.update',$attributes->id) }}" method="POST">
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
                                    <input type="text" name="title" value="{{ $attributes->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Danh mục cha</label>
                                    <div class="row">
                                        <label for="parent">Danh mục :</label>
                                        <select name="product[]" id="product" class="form-control select2"
                                                multiple="multiple" data-placeholder="Select a Tag">
                                            @foreach($productss as $cat)
                                                <option value="{{ $cat->id }}"
                                                        @if(explode('|',$attributes->product_attributes) && in_array($cat->id,explode('|',$attributes->product_attributes))) selected @endif >{{ $cat->title }}</option>

                                            @endforeach
                                        </select>
                                        <script type="text/javascript">
                                            $(function () {
                                                //Initialize Select2 Elements
                                                $('.select2').select2();
                                            })
                                        </script>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mô tả danh mục</label>
                                        <textarea name="overview" class="form-control"
                                                  rows="4">{{ $attributes->overview}}</textarea>
                                    </div>
                                </div>


                            </div>
                        </div>

                        @include('admins.layouts.button-edit',['url'=>route('admin.product-categories.index'),'display'=>''])
                    </div>
                </div>
        </div>
        </form>
        </div>
    </section>
@endsection
