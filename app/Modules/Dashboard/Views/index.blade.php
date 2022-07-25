@extends('admins.master')
@section('main')
    <!-- Main content -->
    @include('admins.partials.breadcrumb',['title'=>'Dashboard'])
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>1</h3>

                                <p>ĐƠn trong ngày</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>3</h3>

                                <p>Tổng đơn hoàn thành</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-plus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>2</h3>

                                <p>Tổng đơn nợ</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-minus-circle"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>1</h3>

                                <p>Người dùng đăng kí</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    <!-- /.content -->
@endsection
