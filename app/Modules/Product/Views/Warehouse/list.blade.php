@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0">
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm dataTables_filter" style="width: 350px;">
                                    <form action="" name="formSearch" method="GET">
                                        <div class="input-group">
                                            <select name="type" class="form-control" style="">
                                                <option value="">-- Search Type --</option>
                                                <option value="all"
                                                        @if(app("request")->input("type")=="all") selected="selected" @endif>
                                                    Tất cả
                                                </option>
                                                <option value="title"
                                                        @if(app("request")->input("type")=="title") selected="selected" @endif>
                                                    Theo tên
                                                </option>
                                            </select>
                                            <input type="text" name="keyword" class="form-control" placeholder="Search"
                                                   value="{{ app("request")->input("keyword") }}"/>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="card-body" style="padding-top: 0;">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá bán</th>
                                        <th>Giá khuyến mãi</th>
                                        <th>Số lượng</th>
                                        <th>Bảo hành</th>
                                        <th>VAT</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($products)>0)
                                        @foreach($products as $product)
                                            <form action="{{ route('admin.warehouse.update',$product->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PUT')

                                                <tr class="remove-{{ $product->id }}">
                                                    <td>{{ $product->title }}</td>
                                                    <td style="width: 120px">
                                                        <div class="box-image-table">
                                                            <img
                                                                src="{!! ($product->images!="")?url($product->images):URL::asset('images/no_picture.gif') !!}"
                                                                alt="{{ $product->title }}"
                                                                class="img-table">
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <input class="form-control " data-type='currency'
                                                               data-id="{{$product->id}}" min="0" name="regular_price"
                                                               type="text" placeholder="Giá bán thường"
                                                               value="{{number_format($product->regular_price)}}"
                                                               id="regular_price">
                                                    </td>

                                                    <td>
                                                        <input class="form-control " data-type='currency'
                                                               data-id="{{$product->id}}" min="0" name="sale_price"
                                                               type="text" placeholder="Giá khuyến mại"
                                                               value="{{number_format($product->sale_price)}}"
                                                               id="sale_price">

                                                    </td>

                                                    <td>
                                                        <input type="number" min="0" name="quantity"
                                                               value="{{ $product->quantity }}"
                                                               class="form-control">
                                                    </td>
                                                    <td>
                                                        <input class="form-control " min="0" name="guarantee"
                                                               type="number" placeholder="tháng"
                                                               value="{{ $product->guarantee }}" id="guarantee">
                                                    <td>

                                                        <select class="form-control " name="vat">
                                                            @if($product->vat == 0) On
                                                            <option value="0">Không có VAT</option>@endif
                                                            @if($product->vat == 1) On
                                                            <option value="0">Có VAT</option>@endif
                                                            @if($product->vat == 2) On
                                                            <option value="0">Không hiện VAT</option>@endif
                                                            <option value="0">Không có VAT</option>
                                                            <option value="1">Có VAT</option>
                                                            <option value="2">Không hiện VAT</option>
                                                        </select>
                                                        <br>
                                                        <input type="number" min="0" name="value_vat"
                                                               value="{{ $product->value_vat}}"
                                                               class="form-control" placeholder="Giá trị VAT  %">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-sm btn-primary"><i
                                                                class="fa fa-cog"></i> Cập nhập
                                                        </button>

                                                    </td>

                                                </tr>

                                            </form>

                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10" class="text-center">Dữ liệu đang cập nhật</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-bottom">
                                <div class="row">
                                    @if($products->links())
                                        <div class="col-12 col-md-7">
                                            <div class="float-right">
                                                <div
                                                    class="pagination">{!! $products->links('pagination::bootstrap-4') !!}</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--modal delete-->

    <!-- End Delete form-->
@endsection


@section('scripts')
    <!-- Delete form -->
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
            console.log(22)
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
