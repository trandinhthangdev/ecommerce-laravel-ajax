<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/client/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body>
	<div class="container">
		<a href="check_out_confirm.html/{{ $check_out->token_check_out }}"><button class="btn btn-dark">Confirm</button></a>
	</div>
	<div class="container">
		{!! $check_out->order_detail !!}
	</div>
    <script src="assets/client/js/jquery.min.js"></script>
    <script src="assets/client/js/popper.min.js"></script>
    <script src="assets/client/js/bootstrap.min.js"></script>
    <script src="assets/client/js/toastr.min.js"></script>
</body>
</html>