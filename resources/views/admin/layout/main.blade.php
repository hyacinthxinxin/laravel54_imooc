<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('/assets/css/app.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="content-wrapper">
        @yield('content')
    </div>
    <div class="control-sidebar-bg">
    </div>
</div>
<!-- ./wrapper -->
<script src="{{ asset ("/assets/js/app.js") }}" type="text/javascript"></script>
<script src='/js/admin.js?v=' .time()></script>
@yield('script')
</body>
</html>
