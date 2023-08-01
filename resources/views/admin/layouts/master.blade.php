<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - Admin Ecommerce Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/admin/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
</head>
<body>
    @include('admin.layouts.header')
    
    @yield('content')

    @include('admin.layouts.footer')

    <script src="assets/admin/js/jquery.min.js"></script>
    <script src="assets/admin/js/popper.min.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/toastr.min.js"></script>
    @stack('script')
</body>
</html>