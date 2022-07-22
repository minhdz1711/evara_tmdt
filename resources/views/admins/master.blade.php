<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} |  {{ @$settings['website_name'] }}</title>
    <link rel="icon" type="image/png" href="{{ (@$settings['website_favicon']!="")?url(@$settings['website_favicon']):'' }}"/>
    <link rel="icon" type="image/png" href="{{ (@$settings['website_favicon']!="")?url(@$settings['website_favicon']):'' }}"/>
    @include('admins.partials.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admins.partials.header-top')
    @include('admins.partials.sidebar')
    <div class="content-wrapper">
        @yield('main')
    </div>
    @yield('scripts')
    @include('admins.partials.footer')
</div>
</body>
</html>