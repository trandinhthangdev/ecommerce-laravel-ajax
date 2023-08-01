<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Admin Ecommerce Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="{{ asset('') }}">
    <link rel="stylesheet" href="assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/admin/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    
</head>
<body class="bg-dark h-100">
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-12 text-light font-weight-bolder mt-5">
				<h2 class="text-center mb-3">Login System</h2>
				<div class="dropdown-divider mb-5"></div>
				<form action="{{ route('admin_login_post') }}" method="POST">
					@csrf
				    <div class="form-group">
				        <label for="email">Email :</label>
				        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email ..." required>
				    </div>
				    <div class="form-group">
				        <label for="password">Password :</label>
				        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password ..." required>
                       	@if($errors->has('password'))
		                <div class="alert alert-danger" role="alert">
				            {{ $errors->first('password') }}
				        </div>			            
                       	@endif


				    </div>
				    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember"> Remember me
                        </label>
                    </div>
				    <button type="submit" class="btn btn-light">LOGIN</button>
				</form>
			</div>
		</div>
	</div>
	   
    <script src="assets/admin/js/jquery.min.js"></script>
    <script src="assets/admin/js/popper.min.js"></script>
    <script src="assets/admin/js/bootstrap.min.js"></script>
    <script src="assets/admin/js/toastr.min.js"></script>
   	
   	@if(session('error'))
    <script type="text/javascript">
	    toastr.error("{{ session('error') }}", 'Response', {timeOut: 1000});   
    </script>
	@endif

</body>
</html>