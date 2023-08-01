@extends('client.layouts.master')

@section('title', 'Check Out')

@section('content')
<div class="container text-dark">
	<div class="row mt-4">
		<div class="col-12">
			<nav aria-label="breadcrumb" class="font-weight-bolder">
                <ol class="breadcrumb p-3">
                    <li class=" text-dark font-weight-bolder breadcrumb-item active" style="font-size: 28px;" aria-current="page">Check out
                    </li>
                </ol>
            </nav>
		</div>
	</div>
	<div class="row mt-4" id="check_out_show">
		<div class="col-md-8 mt-4">
			<div class="row">
				<div class="col-12">
		            <nav aria-label="breadcrumb" class="font-weight-bolder">
		                <ol class="breadcrumb">
		                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Billing address
		                    </li>
		                </ol>
		            </nav>                  
		        </div>
		        <div class="col-12 font-weight-bolder">
		        	<form method="POST">
					    <div class="form-group">
					        <label for="name">Name :</label>
					        <input type="text" class="form-control" id="name" placeholder="Enter name ..." name="name" value="{{ $customer->name}}">
					    </div>
					    <div class="form-group">
					        <label for="address">Address :</label>
					        <input type="text" class="form-control" id="address" placeholder="Enter address ..." name="address" value="{{ $customer->address}}">
					    </div>
					    <div class="form-group">
					        <label for="phone">Phone :</label>
					        <input type="text" class="form-control" id="phone" placeholder="Enter phone ..." name="phone" value="{{ $customer->phone}}">
					    </div>
					    <button type="button" class="btn btn-dark" id="check_out_btn">Buy It Now</button>
					</form>
		        </div>
			</div>
		</div>
		<div class="col-md-4 mt-4">
			<div class="row">
				<div class="col-12">
		            <nav aria-label="breadcrumb" class="font-weight-bolder">
		                <ol class="breadcrumb">
		                    <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">
								Your cart 
								<span class="badge badge-secondary badge-pill" id="count_cart_check_out"></span>
		                    </li>
		                </ol>
		            </nav>                  
		        </div>
		        <div class="col-12 font-weight-bolder">
		        	<ul class="list-group mb-3 " id="show_cart_check_out">
					    
					</ul>
		        </div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('script')

@endpush
