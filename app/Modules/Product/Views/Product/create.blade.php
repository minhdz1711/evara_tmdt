@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.products.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Thêm sản phẩm mới</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên sản phẩm <b>*</b></label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung <b>*</b></label>
                                    <textarea name="content" id="description"
                                              class="form-control @if($errors->has('content')) is-invalid @endif">{{ old('content') }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Nội dung mô tả</label>
                                    <textarea name="overview" class="form-control"
                                              rows="5">{{ old('overview') }}</textarea>
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
                                                {!! \App\Models\Config::showCheckCategories($categories,0,'',[],'category_id[]') !!}
                                            </ul>
                                        @else
                                            <ul>
                                                <li><a href="{{ route('admin.product-categories.index') }}"
                                                       style="font-size: 14px">Thêm danh mục</a>
                                                </li>
                                            </ul>
                                        @endif
                                    </div>
                                    @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <form>
                                        @csrf
                                        <div class="previewThumbnail" style="width: 200px">
                                            <img id="logo-icon" class="imgPreview"
                                                 src="{{ (old('images')!="")?old('images'):URL::asset('images/no_picture.gif') }}"/>
                                            <input type="hidden" name="images" id="image" class="inputImg" value=""/>
                                            <a href="javascript:void(0)"
                                               onclick="selectFileWithCKFinder('image', 'logo-icon')">Thêm ảnh đại
                                                diện</a>
                                            <a href="javascript:void(0);"
                                               class="btn btn-outline-danger btn-sm btn-close"
                                               onclick="removeFileWithCKFinder('image', 'logo-icon')"><i
                                                    class="fa fa-close"></i></a>
                                        </div>
                                    </form>
                                </div>

                                <div class="form-group">
                                    @include('admins.layouts.button-add',['url'=>route('admin.products.index'),'display'=>''])
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Dữ liệu sản phẩm</h3>
                            </div>
                            <div class="card-header">
                                <label for="">Thương hiệu sản phẩm</label>
                                <select name="brands_id" class="form-control">
                                    <option value="0">--- Trống ---</option>
                                    {!! \App\Models\Config::showCategories($parents) !!}
                                </select>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Giá bán</label>
                                    <input type="text" name="regular_price" value="{{ old('regular_price') }}"
                                           class="form-control @if($errors->has('regular_price')) is-invalid @endif"
                                           data-type='currency' min="0">
                                    @error('regular_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Giá khuyến mại</label>
                                    <input type="text" name="sale_price" value="{{ old('sale_price') }}"
                                           class="form-control @if($errors->has('sale_price')) is-invalid @endif"
                                           data-type='currency' min="0">
                                    @error('sale_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Sku</label>
                                    <input type="text" name="sku" value="{{ old('sku') }}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="number" min="0" name="quantity" value="1"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Số tháng bảo hành</label>
                                    <input class="form-control " min="0" name="guarantee" type="number"
                                           placeholder="tháng" value="0" id="guarantee">

                                </div>
                                <div class="form-group">
                                    <label for="">Số sản phẩm đã bán</label>
                                    <input class="form-control " min="0" name="number_sell" type="number"
                                           placeholder="Số sản phẩm đã bán" value="0" id="number_sell">
                                </div>
                                <div class="form-group">
                                    <label for="">Lượt xem:</label>
                                    <input class="form-control " min="0" name="view" type="number"
                                           placeholder="Lượt xem:" value="0" id="view">
                                </div>
                                <div class="form-group">
                                    <label for="">Thứ tự</label>
                                    <input class="form-control " min="0" name="order" type="number" placeholder="Thứ tự"
                                           value="0" id="order">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="is_instock" style="width: 100%">Còn hàng:</label>
                                            <input name="is_instock" id="is_instock" type="checkbox" value="1"
                                                   data-toggle="toggle" style="display: none;" checked="checked">
                                            <div class="Switch Round On" style="vertical-align:top;margin-left:10px;">
                                                <div class="Toggle"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
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
                        </div><!--data-->
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $("input[data-type='currency']").on({
            keyup: function () {
                formatCurrency($(this));
            },
            blur: function () {
                formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
            // format number 1000000 to 1,234,567
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
            // get input value
            var input_val = input.val();

            // don't validate empty input
            if (input_val === "") {
                return;
            }

            // original length
            var original_len = input_val.length;

            // initial caret position
            var caret_pos = input.prop("selectionStart");

            // check for decimal
            if (input_val.indexOf(".") >= 0) {
                var decimal_pos = input_val.indexOf(".");

                // split number by decimal point
                var left_side = input_val.substring(0, decimal_pos);
                var right_side = input_val.substring(decimal_pos);

                // add commas to left side of number
                left_side = formatNumber(left_side);

                // validate right side
                right_side = formatNumber(right_side);

                // On blur make sure 2 numbers after decimal
                if (blur === "blur") {
                    right_side += "00";
                }

                // Limit decimal to only 2 digits
                right_side = right_side.substring(0, 2);

                // join number by .
                input_val = "" + left_side + "." + right_side;

            } else {
                input_val = formatNumber(input_val);
                input_val = "" + input_val;

                // final formatting
                if (blur === "blur") {
                    input_val += "";
                }
            }

            // send updated string to input
            input.val(input_val);

            // put caret back in the right position
            var updated_len = input_val.length;
            caret_pos = updated_len - original_len + caret_pos;
            input[0].setSelectionRange(caret_pos, caret_pos);
        }
    </script>
@endsection



