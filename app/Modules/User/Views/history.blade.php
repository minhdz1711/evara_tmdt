@extends('admins.master')
@section('main')
    @include('admins.partials.breadcrumb',['title'=>$title])

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12">
                    <div class="card">
                        <div class="card-header" style="border-bottom: 0">
                            <h3 class="card-title">Lịch Sử </h3>
                        </div>
                        <div class="card-body" style="padding-top: 0;">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped dataTable">
                                    <thead>
                                    <tr>
                                        <th>Người thực hiện</th>
                                        <th>Hoạt động</th>
                                        <th>Loại</th>
                                        <th>Tên hiển thị</th>
                                        <th>Ngày tạo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($history)>0)
                                        @foreach($history as $user)
                                            <tr class="remove-{{ $user->id }}">
                                                <td>
                                                    {{$userse->username}}
                                                </td>
                                                <td>{{ $user->work }}</td>
                                                <td>{{ $user->type }}</td>
                                                <td>{{ $user->content }}</td>
                                                <td>{{ date_format($user->created_at,'d/m/Y H:i:s') }}</td>
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

                                    @if($history->links())
                                        <div class="col-12 col-md-7">
                                            <div class="float-right">
                                                <div class="pagination">{!! $history->links('pagination::bootstrap-4') !!}</div>
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

@endsection
