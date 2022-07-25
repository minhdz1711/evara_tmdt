@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0">
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
                        </div>
                        <div class="card-body">
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
                                        <th>Tên người bình luận</th>
                                        <th>Nội dung</th>
                                        <th>Sản phẩm</th>
                                        <th>Ngày tạo</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($comments)>0)
                                        @foreach($comments as $comment)
                                            <tr class="remove-{{ $comment->id }}">
                                                <td class="center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input ace mycheckbox"
                                                               type="checkbox"
                                                               id="checkall-{{ $comment->id }}"
                                                               value="{{ $comment->id }}" name="check[]">
                                                        <label for="checkall-{{ $comment->id }}"
                                                               class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $comment->title }}</td>
                                                <td>
                                                    {!! $comment->content !!}
                                                </td>
                                                <td>
                                                    <a href="/{{ $comment->slug }}.html">{!! App\Models\Config::getProductComment($comment->comment_product_id) !!}</a>
                                                </td>
                                                <td>{{ $comment->date }}</td>
                                                <td>
                                                    <div data-table="comments" data-id="{{ $comment->id }}"
                                                         data-col="is_active"
                                                         class="Switch Round  @if($comment->is_active == 1) On @else Off @endif"
                                                         style="vertical-align:top;margin-left:10px;">
                                                        <div class="Toggle"></div>
                                                    </div>
                                                </td>

                                                <td>

                                                    <a href="#" name="{{ $comment->title }}"
                                                       link="{{ route('admin.comments.destroy',$comment->id) }}"
                                                       class="deleteClick red id-btn-dialog2" data-toggle="modal"
                                                       data-target="#deleteModal"> <span
                                                                class="btn btn-danger btn-sm"><i title="Delete"
                                                                                                 class="ace-icon fa fa-trash-o bigger-130"></i></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">Dữ liệu đang cập nhật</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-bottom">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-5">
                                        <div class="dataTables_info" id="example2_info" role="status"
                                             aria-live="polite">
                                            <div class="form-group row">
                                                <div class="col-md-8 col-lg-7">
                                                    <select name="action" class="form-control" id="deleteSelect">
                                                        <option value="">--- Hành động ---</option>
                                                        <option value="delete">Xoá các mục đã chọn</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-lg-5">
                                                    <button type="button" class="btn btn-warning btnDeleteAll"><i
                                                                class="ace-icon fa fa-check-circle bigger-130"></i>
                                                        Thực hiện
                                                    </button>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    @if($comments->links())
                                        <div class="col-12 col-md-6 col-lg-7">
                                            <div class="float-right">
                                                <div class="pagination">{!! $comments->links('pagination::bootstrap-4') !!}</div>
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
                $("#deleteMes").html("Bạn muốn xoá bình luận của <b>" + name + "</b> ?");
            });

            $('.btnDeleteAll').on('click', function () {
                var $delete = $('#deleteSelect').val();
                var id = [];
                $('.mycheckbox:checked').each(function () {
                    id.push($(this).val());
                });
                if ($delete != "") {
                    $.ajax({
                        url: "{{ route('admin.comments.deleteAll') }}",
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
