@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0">
                            <h3 class="card-title">Danh sách trình diễn ảnh</h3>
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
                                                <option value="author"
                                                        @if(app("request")->input("type")=="author") selected="selected" @endif>
                                                    Theo tác giả
                                                </option>
                                                <option value="status"
                                                        @if(app("request")->input("type")=="status") selected="selected" @endif>
                                                    By Status (0 is Inactive/1 is Active)
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
                            <div class="float-right" style="margin-right: 10px">
                                <a href="{{ route('admin.banners.create') }}">
                                    <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Thêm mới</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="padding-top: 0;">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <tr>
                                        <th class="center sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input ace" type="checkbox"
                                                       id="checkall" onclick="toggle(this);">
                                                <label for="checkall" class="custom-control-label"></label>
                                            </div>
                                        </th>
                                        <th>Hình ảnh</th>
                                        <th>Vị trí</th>
                                        <th>Sắp xếp</th>
                                        <th>Trạng thái</th>
                                        <th>Tác giả</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($banners)>0)
                                        @foreach($banners as $banner)
                                            <tr class="remove-{{ $banner->id }}">
                                                <td class="center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input ace mycheckbox"
                                                               type="checkbox"
                                                               id="checkall-{{ $banner->id }}"
                                                               value="{{ $banner->id }}" name="check[]">
                                                        <label for="checkall-{{ $banner->id }}"
                                                               class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td style="width: 120px">
                                                    <div class="box-image-table">
                                                        <img src="{!! ($banner->images!="")?url($banner->images):URL::asset('images/no_picture.gif') !!}"
                                                             alt="{{ $banner->title }}"
                                                             class="img-table">
                                                    </div>
                                                </td>
                                                {{--<td>{!! \App\Models\Config::showPositionBanner($banner->position) !!}</td>--}}
                                                <td>{{ $banner->order }}</td>
                                                <td>
                                                    <div data-table="banners" data-id="{{ $banner->id }}"
                                                         data-col="is_active"
                                                         class="Switch Round  @if($banner->is_active == 1) On @else Off @endif"
                                                         style="vertical-align:top;margin-left:10px;">
                                                        <div class="Toggle"></div>
                                                    </div>
                                                </td>
                                                <td>{!! \App\Models\Config::showAuthor($banner->id_user) !!}</td>
                                                <td>{{ date_format($banner->created_at,'d/m/Y H:i:s') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.banners.edit',$banner->id) }}"
                                                       class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" name="{{ $banner->title }}"
                                                       link="{{ route('admin.banners.destroy',$banner->id) }}"
                                                       class="deleteClick red id-btn-dialog2" data-toggle="modal"
                                                       data-target="#deleteModal" style="margin-bottom: 3px"> <span
                                                                class="btn btn-danger btn-sm"><i title="Delete"
                                                                                                 class="ace-icon fa fa-trash-o bigger-130"></i></span></a>
                                                </td>
                                            </tr>
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
                                    <div class="col-12 col-md-5">
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">
                                            <div class="form-group row">
                                                <div class="col-md-4">
                                                    <select name="action" class="form-control" id="deleteSelect">
                                                        <option value="">--- Hành động ---</option>
                                                        <option value="delete">Xoá các mục đã chọn</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-warning btnDeleteAll"><i
                                                                class="ace-icon fa fa-check-circle bigger-130"></i>
                                                        Thực hiện
                                                    </button>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    @if($banners->links())
                                        <div class="col-12 col-md-7">
                                            <div class="float-right">
                                                <div class="pagination">{!! $banners->links('pagination::bootstrap-4') !!}</div>
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
@endsection


@section('scripts')
    <!-- Delete form -->
    <script type="text/javascript">
        $(document).ready(function () {
            $(".deleteClick").click(function () {
                var link = $(this).attr('link');
                var name = $(this).attr('name');
                $("#deleteForm").attr('action', link);
                $("#deleteMes").html("Bạn muốn xoá banner <b>" + name + "</b> ?");
            });

            $('.btnDeleteAll').on('click', function () {
                var $delete = $('#deleteSelect').val();
                var id = [];
                $('.mycheckbox:checked').each(function () {
                    id.push($(this).val());
                });
                if ($delete != "") {
                    $.ajax({
                        url: "{{ route('admin.banners.deleteAll') }}",
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
                } else {
                    $.toast({
                        heading: 'Đã xảy ra lỗi',
                        text: 'Bạn chưa chọn hành động nào !!!',
                        icon: 'error',
                        loader: true,
                        hideAfter: 2000,
                        position: "top-right"
                    });
                }
            });
        });
    </script>
@endsection