<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ @$settings['website_name'] }} | 404 Page not found</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper" style="max-width: 100%;width: 100%;margin: 0px !important;">
        <!-- Content Header (Page header) -->
        <section class="content-header"></section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page">
                <h2 class="headline text-danger"> 500</h2>

                <div class="error-content">
                    <h3><i class="fas fa-exclamation-triangle text-danger"></i> Oops! Page not found.</h3>
                    <p>Sorry, an error has occured, Requested page not found!</p>
                    <div class="mt-2">
                        <a class="btn btn-danger" href="#"> <i class="fa fa-long-arrow-left"></i> Về trang chủ </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

</div>

<!-- jQuery -->
<script src="{{ URL::asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('/assets/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
