<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Bootstrap style -->
  <link rel="stylesheet" href="{{ asset('/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('/plugins/ionicons/css/ionicons.min.css') }}">
  <!-- Extra styles -->
  @yield('styles')
  <!-- AdminLTE style -->
  <link rel="stylesheet" href="{{ asset('/plugins/adminLTE/css/AdminLTE.min.css') }}">
  <!-- AdminLTE theme style -->
  <link rel="stylesheet" href="{{ asset('/plugins/adminLTE/css/skins/_all-skins.min.css') }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <body>
    @yield('content')

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="{{ asset('/plugins/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/plugins/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Extra scripts -->
    @yield('scripts')
    <!-- AdminLTE App -->
    <script src="{{ asset('/plugins/adminLTE/js/adminlte.min.js') }}"></script>
    <!-- Application code -->
    <script src="{{ asset('/js/app.js') }}"></script>
  </body>

</html>