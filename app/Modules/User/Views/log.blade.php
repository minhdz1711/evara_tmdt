@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0">
                            <h3 class="card-title">Lịch sử đăng nhập</h3>
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
                                        <th>Thông tin khách</th>
                                        <th>IP</th>
                                        <th>User Agent</th>
                                        <th>Login</th>
                                        <th>Logut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($histories)>0)
                                        @foreach($histories as $history)
                                            <tr class="remove-{{ $history->id }}">
                                                <td class="center">
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input ace mycheckbox"
                                                               type="checkbox"
                                                               id="checkall-{{ $history->id }}"
                                                               value="{{ $history->id }}" name="check[]">
                                                        <label for="checkall-{{ $history->id }}"
                                                               class="custom-control-label"></label>
                                                    </div>
                                                </td>
                                                <td style="width: 250px">{!! \App\Models\Config::showUserInfo($history->authenticatable_id) !!}</td>
                                                <td>{{ $history->ip_address }}</td>
                                                <td>{{ $history->user_agent }}</td>
                                                <td>{{ $history->login_at }}</td>
                                                <td>{{ $history->logout_at }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Dữ liệu đang cập nhật</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-bottom">
                                <div class="row">
                                    <div class="col-12 col-md-6">
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
                                    @if($histories->links())
                                        <div class="col-12 col-md-7">
                                            <div class="float-right">
                                                <div class="pagination">{!! $histories->links('pagination::bootstrap-4') !!}</div>
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
            $('.btnDeleteAll').on('click', function () {
                var $delete = $('#deleteSelect').val();
                var id = [];
                $('.mycheckbox:checked').each(function () {
                    id.push($(this).val());
                });
                if ($delete != "") {
                    $.ajax({
                        url: "{{ route('admin.users.logs.deleteAll') }}",
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