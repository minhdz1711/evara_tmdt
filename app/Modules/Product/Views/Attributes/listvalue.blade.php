@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.product_attribute_item.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Quản lý thuộc tính</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Tên thuộc tính <b>*</b></label>
                                    <input type="text" name="title" value="{{ $category->title }}"
                                           class="form-control @if($errors->has('title')) is-invalid @endif">
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <input type="hidden" name="id" id="id" value="{{$category->id}}">
                                <div class="col-md-12">

                                    <table id="attribute-value-table" class="table table-striped table-sm">
                                        <tr class="thead-light">
                                            <th scope="col">Attribute Value</th>
                                            <th scope="col" class="text-center">Xóa</th>
                                        </tr>
                                        @foreach($product_attribute_item as $attribute_value)
                                            <tr class="attribute-value-row">
                                                <td>
                                                    <input type="hidden" name="attribute_value_id[]"
                                                           value="{{ $attribute_value->id }}">
                                                    <input name="attribute_value_name[{{ $attribute_value->id }}]"
                                                           type="text" class="form-control "
                                                           placeholder="Attribute value" required
                                                           value="{{ $attribute_value->title }}">
                                                </td>
                                                <td class="text-center">
                                                    <button id="" class="remove-img btn btn-danger btn-sm  btn-addcart"
                                                            type="button" title="Remove attribute value"
                                                            data-id="{{ $attribute_value->id }}"><i
                                                            class="fa fa-times-circle"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            countImage = 1;
                                            $("#add-new-attribute-value").click(function () {
                                                $("#attribute-value-table tbody").append('<tr class="attribute-value-row"><td><input name="attribute_value_name[]" type="text" class="form-control " placeholder="Attribute value" required></td><td class="text-center"><button id="" class="remove-img btn btn-danger btn-sm" type="button" title="Remove Image"><i class="fa fa-times-circle"></i></button></td></tr>');
                                                countImage++;
                                            });
                                            $("body").on("click", ".remove-img", function () {
                                                $(this).parents("tr.attribute-value-row").remove();
                                            });
                                        });
                                    </script>
                                    <!-- /.card-body -->
                                </div>
                                <div class="form-group">
                                    <button id="add-new-attribute-value" class="btn btn-success float-right btn-sm"
                                            type="button"
                                            title="Add New Option"><i class="fa fa-plus-circle"></i> Thêm giá trị
                                    </button>
                                </div>


                            </div>
                        </div>

                        @include('admins.layouts.button-edit',['url'=>route('admin.product-attributes.index'),'display'=>''])
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        $('body').on('click', '.btn-addcart', function () {

            var id = $(this).attr('data-id');
            var type = "add";

            $.ajax({
                url: "{{ route('admin.categoriess.deleteAll') }}",
                type: "post",
                dataType: "text",
                data: {_token: '{{ @csrf_token() }}', id: id},
                success: function (data) {
                    var $responsive = $.parseJSON(data);
                    if ($responsive.success == true) {
                        $.toast({
                            heading: 'Thành công',
                            text: $responsive.message,
                            icon: 'success',
                            loader: true,
                            hideAfter: 2000,
                            position: "top-right"
                        });
                        $('.mycheckbox:checked').each(function () {
                            $('.remove-' + $(this).val()).remove();
                        });
                    } else {
                        $.toast({
                            heading: 'Đã xảy ra lỗi',
                            text: $responsive.message,
                            icon: 'error',
                            loader: true,
                            hideAfter: 2000,
                            position: "top-right"
                        });
                    }
                }
            });
        })
    </script>
@endsection
