@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Menu</h3>
                        </div>
                        <div class="card-body">
                            @include('Menu::MenuItem.menu-add')
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="card">
                        <div class="card-header" style="display: flex">
                            <button type="button" class="btn btn-sm btn-success"
                                    style="margin-right: 10px"
                                    id="btnDeleteAll"><i
                                    class="fa fa-trash"></i> Xoá tất cả menu
                            </button>
                            <button type="button" class="btn btn-sm btn-primary"
                                    id="btnSaveSort"
                                    style="margin-right: 10px"
                                   ><i
                                    class="fa fa-save"></i> Cập nhật sắp xếp
                            </button>
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-sm btn-danger"><i
                                    class="fa fa-reply"></i> Trở lại</a>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkAll"
                                           onclick="toggleMenu(this)">
                                    <label class="custom-control-label" for="checkAll">Chọn tất cả
                                    </label>
                                </div>
                            </div>
                            <div class="dd" id="nestable">
                                {!! \App\Models\Config::getMenu($menu_items,0,'') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--modal delete-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="deleteForm" action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xoá dữ liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="deleteMes" class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary btn-sm">Xoá</button>
                    </div>
                    <input type="hidden" name="_method" value="delete"/>
                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
    <!-- End Delete form-->

    <!--modal-edit-->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editForm" action="" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa menu <span id="menu-title"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="editBody" class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end-modal-edit-->
@endsection
@section('scripts')
    <!--menu-->
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            $('.js_add_menu').on('click', function () {
                var $type = $(this).data('type'), $data = [];
                if ($type == "product-category") {
                    $('.product-category ul li input:checked').each(function () {
                        $data.push({
                            type: 'product-category',
                            id: $(this).val()
                        });
                    });
                } else if ($type == "page") {
                    $('.page ul li input:checked').each(function () {
                        $data.push({
                            type: 'page',
                            id: $(this).val()
                        });
                    });
                } else if ($type == "post-category") {
                    $('.post-category ul li input:checked').each(function () {
                        $data.push({
                            type: 'post-category',
                            id: $(this).val()
                        });
                    });
                } else if ($type == "post") {
                    $('.post ul li input:checked').each(function () {
                        $data.push({
                            type: 'post',
                            id: $(this).val()
                        });
                    });
                } else if ($type == "product") {
                    $('.product ul li input:checked').each(function () {
                        $data.push({
                            type: 'product',
                            id: $(this).val()
                        });
                    });
                } else if ($type == "link") {
                    $data.push({
                        type: 'link',
                        title: $('#title_name').val(),
                        link: $('#title_url').val()
                    });
                }

                if ($data.length > 0) {
                    $.ajax({
                        url: "{{ route('admin.menu-item.store') }}",
                        type: "post",
                        dataType: "text",
                        data: {_token: '{{ @csrf_token() }}', id: '{{ $menu->id }}', data: $data},
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
                                location.reload();
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
                } else {
                    $.toast({
                        heading: 'Đã xảy ra lỗi',
                        text: "Bạn cần chọn nội dung để thêm vào menu !!!",
                        icon: 'error',
                        loader: true,
                        hideAfter: 3000,
                        position: "top-right"
                    });
                }
            });
        });
    </script>

    <!-- Delete form -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".deleteClick").click(function () {
                var link = $(this).attr('link');
                var name = $(this).attr('name');
                $("#deleteForm").attr('action', link);
                $("#deleteMes").html("Bạn muốn xoá menu <b>" + name + "</b> ?");
            });

            $(".editClick").click(function () {
                var link = $(this).attr('link'), name = $(this).attr('name'), id = $(this).data('id');
                $("#editForm").attr('action', link);
                $("#menu-title").html(name);
                $.ajax({
                    url: "{{ route('admin.menu-item.modal.edit') }}",
                    type: "GET",
                    dataType: "text",
                    data: {_token: '{{ @csrf_token() }}', id: id},
                    success: function (data) {
                        $('#editBody').html(data);
                    }
                });
            });
        });

        $('#btnDeleteAll').on('click', function () {
            var id = [];
            $('.check-permision:checked').each(function () {
                id.push($(this).val());
            });
            if (id.length > 0 && id != undefined) {
                $.ajax({
                    url: "{{ route('admin.menu-item.deleteAll') }}",
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
                            $('.check-permision:checked').each(function () {
                                $('#menu-item-' + $(this).val()).remove();
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
            } else {
                $.toast({
                    heading: 'Đã xảy ra lỗi',
                    text: 'Bạn chưa chọn menu cần xoá !!!',
                    icon: 'error',
                    loader: true,
                    hideAfter: 2000,
                    position: "top-right"
                });
            }
        });


        //menu
        jQuery(document).ready(function ($) {
            // activate Nestable for list 1
            $('#nestable').nestable({
            }).nestable('collapseAll');

            $('#btnSaveSort').on('click', function () {
                let menu = $('#nestable');
                let menuJson = window.JSON.stringify(menu.nestable('serialize'));
                console.log(menuJson);
                $.ajax({
                    url: "{{ route('admin.menu-item.saveSort') }}",
                    type: "post",
                    dataType: "json",
                    data: {_token: '{{ @csrf_token() }}', id: '{{ $menu->id }}', data: menuJson},
                    success: function (data) {
                        if (data.success == true) {
                            $.toast({
                                heading: 'Thành công',
                                text: data.message,
                                icon: 'success',
                                loader: true,
                                hideAfter: 2000,
                                position: "top-right"
                            });
                            location.load();
                        } else {
                            $.toast({
                                heading: 'Đã xảy ra lỗi',
                                text: data.message,
                                icon: 'error',
                                loader: true,
                                hideAfter: 2000,
                                position: "top-right"
                            });
                        }
                    }
                })
            });

            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });
    </script>
@endsection
