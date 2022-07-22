@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="col-12 col-md-6">
                <a href="{{ route('admin.product.properties',$product->id) }}">
                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Thuộc tính sản phẩm</button>
                </a>
            </div>
            <br>
            <form action="{{ route('admin.products.update',$product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm sản phẩm mới</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên sản phẩm <b>*</b></label>
                                    <input type="text" name="title" value="{{ $product->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung <b>*</b></label>
                                    <textarea name="content" id="description"
                                              class="form-control @if($errors->has('content')) is-invalid @endif">{!! $product->content !!}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung mô tả</label>
                                    <textarea name="overview" class="form-control"
                                              rows="5">{{ $product->overview }}</textarea>
                                </div>
                            </div>
                        </div><!--content-->

                    </div>
                    <div class="col-12 col-md-3">

                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Danh mục</label>
                                    <div class="category-list">
                                        @if(count($categories)>0)
                                            <ul id="categorychecklist-pop" class="categorychecklist form-no-clear">
                                                {!! \App\Models\Config::showCheckCategories($categories,0,'',$arg_id,'category_id[]') !!}
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('admin.product-categories.index') }}"
                                                       style="font-size: 14px">Thêm danh mục</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <div class="previewThumbnail" style="width: 200px">
                                        <img id="logo-icon" class="imgPreview"
                                             src="{{ ($product->images!="")?url($product->images):URL::asset('images/no_picture.gif') }}"/>
                                        <input type="hidden" name="images" id="image" class="inputImg"
                                               value="{{ $product->images }}"/>
                                        <a href="javascript:void(0)"
                                           onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại diện</a>
                                        <a href="javascript:void(0);"
                                           class="btn btn-outline-danger btn-sm btn-close"
                                           onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                class="fa fa-close"></i></a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Thương hiệu sản phẩm</label>
                                    <div class="category-list ">
                                        <select name="brands_id" class="form-control">
                                            <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                            {!! \App\Models\Config::showCategories($parents) !!}
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    @include('admins.layouts.button-edit',['url'=>route('admin.products.index'),'display'=>''])
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Dữ liệu sản phẩm</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Giá bán</label>
                                    <input type="number" name="regular_price" value="{{ $product->regular_price }}"
                                           class="form-control @if($errors->has('regular_price')) is-invalid @endif">
                                    @error('regular_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Giá khuyến mại</label>
                                    <input type="number" name="sale_price" value="{{ $product->sale_price }}"
                                           class="form-control @if($errors->has('sale_price')) is-invalid @endif">
                                    @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sku</label>
                                    <input type="text" name="sku" value="{{ $product->sku }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="text" name="quantity" value="{{ $product->quantity }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Link demo</label>
                                    <input type="text" name="link_view" value="{{ $product->link_view }}"
                                           class="form-control">
                                </div>
                            </div>
                        </div><!--data-->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="is_instock" style="width: 100%">Còn hàng:</label>
                                    <input name="is_instock" id="is_instock" type="checkbox" value="1"
                                           data-toggle="toggle" style="display: none;" checked="checked">
                                    <div class="Switch Round On" style="vertical-align:top;margin-left:10px;">
                                        <div class="Toggle"></div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="is_active" style="width: 100%">Kích hoạt:</label>
                                    <input name="is_active" id="is_active" type="checkbox" value="1"
                                           data-toggle="toggle"
                                           style="display: none;" checked="checked">
                                    <div class="Switch Round On" style="vertical-align:top;margin-left:10px;">
                                        <div class="Toggle"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
