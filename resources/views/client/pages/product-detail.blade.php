@extends('client.layouts.master')

@section('title')
	{{ $product->name }}
@endsection

@section('content')
<div class="container mt-5">
	<div class="row">
		<div class="col-md-9">
			<div class="row">
				<div class="col-md-6">
					<img src="assets/uploads/products/thumbnail/{{ $product->thumbnail }}" alt="" class="img-thumbnail">
				</div>
				<div class="col-md-6">
					<span class="font-weight-bolder">{{ $product->name }}</span>
					<br>
					@if($product->discount_price != null && $product->discount_price != 0)
                    <span class="font-italic text-dark">{{ $product->discount_price }}</span> <span class="font-italic text-dark" style="text-decoration: line-through;">{{ $product->price }}</span>
                    @else
                    <span class="font-italic text-dark">{{ $product->price }}</span>
                    @endif
                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Description</span>
                    <br>
                    <span class="font-italic">{{ $product->description }}</span>
                    <br><br>
                    <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $product->id }}"><span><i class="fa fa-cart-plus"></i></span></button>
				</div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Description Slider</li>
	                    </ol>
	                </nav>                
	            </div>
	            <div class="col-12">
	                <!-- Begin Slider -->
				    <div class="container">
				        <div class="slider">
				            <div id="demo" class="carousel slide" data-ride="carousel">
				                <!-- Indicators -->
				                <ul class="carousel-indicators">
				                    @php
				                    $index = 0;
				                    @endphp
				                    @foreach($product_slider as $slider)
				                    @if($index == 0)
				                    <li data-target="#demo" data-slide-to="{{ $index }}" class="active"></li>
				                    @else
				                    <li data-target="#demo" data-slide-to="{{ $index }}"></li>
				                    @endif
				                    @php
				                    $index++;
				                    @endphp                 
				                    @endforeach
				                </ul>

				                <!-- The slideshow -->
				                <div class="carousel-inner">
				                    @php
				                    $index = 0;
				                    @endphp
				                    @foreach($product_slider as $slider)
				                    @if($index == 0)
				                    <div class="carousel-item active">
				                        <img src="assets/uploads/products/sliders/{{ $slider->image }}" style="height: 100%; width: 100%" class="img-responsive">
				                    </div>
				                    @else
				                    <div class="carousel-item">
			                            <img src="assets/uploads/products/sliders/{{ $slider->image }}" style="height: 100%; width: 100%" class="img-responsive">
				                    </div>
				                    @endif
				                    @php
				                    $index++;
				                    @endphp                    
				                    @endforeach
				                </div>

				                <!-- Left and right controls -->
				                <a class="carousel-control-prev" href="#demo" data-slide="prev">
				                    <span class="carousel-control-prev-icon"></span>
				                </a>
				                <a class="carousel-control-next" href="#demo" data-slide="next">
				                    <span class="carousel-control-next-icon"></span>
				                </a>

				            </div>
				        </div>
				    </div>
				    <!-- End Slider -->	
	            </div>
			</div>
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Overview</li>
	                    </ol>
	                </nav>                
	            </div>
	            <div class="col-12 overflow-hidden">
	            	{!! $product->overview !!}
	            </div>
			</div>

			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Reviews</li>
	                    </ol>
	                </nav>                
	            </div>
	            @if(count($product_star))
	            @php
	            $count_product_star = count($product_star);
	            $count_five_star = 0;
	            $count_four_star = 0;
	            $count_three_star = 0;
	            $count_two_star = 0;
	            $count_one_star = 0;
	            @endphp
	            @foreach($product_star as $pro_sta)
	            	@if($pro_sta->number_star == 5)
						@php
						$count_five_star++;
						@endphp
	            	@elseif($pro_sta->number_star == 4)
						@php
						$count_four_star++;
						@endphp
	            	@elseif($pro_sta->number_star == 3)
						@php
						$count_three_star++;
						@endphp
	            	@elseif($pro_sta->number_star == 2)
						@php
						$count_two_star++;
						@endphp
	            	@elseif($pro_sta->number_star == 1)
						@php
						$count_one_star++;
						@endphp
					@endif
	            @endforeach
                <div class="col-xs-12 col-md-6 text-center">
                    <h1 class="rating-num">{{ $product->star }}</h1>
                    <div class="rating">
                    	@php
                        $star = $product->star;
                        $star_round = round($star);
                        @endphp
                        <span><i class="fa fa-star {{ ($star >= 1) ? 'text-dark' : 'text-secondary' }}"></i><span>
                        <span><i class="fa fa-star {{ ($star >= 2) ? 'text-dark' : 'text-secondary' }}"></i><span>
                       	<span><i class="fa fa-star {{ ($star >= 3) ? 'text-dark' : 'text-secondary' }}"></i><span>
                        <span><i class="fa fa-star {{ ($star >= 4) ? 'text-dark' : 'text-secondary' }}"></i><span>
                        <span><i class="fa fa-star {{ ($star >= 5) ? 'text-dark' : 'text-secondary' }}"></i><span>
                    </div>
                </div>
			    <div class="col-xs-12 col-md-6">
                    <div class="row rating-desc">
                        <div class="col-xs-2 col-md-2 text-right">
                            <span><i class="fa fa-star text-info"></i></span> 5
                        </div>
                        <div class="col-xs-7 col-md-8">
                            <div class="progress progress-striped">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_five_star*100)/$count_product_star .'%' }}">
                                    <span class="sr-only">{{ ($count_five_star*100)/$count_product_star .'%' }}</span>		                              
                                </div>			     
                            </div>
                        </div>
						<div class="col-xs-1 col-md-1">
							<span class="badge badge-dark badge-pill">{{ $count_five_star }}</span>
						</div>
                        <!-- end 5 -->

                        <div class="col-xs-2 col-md-2 text-right">
                            <span><i class="fa fa-star text-info"></i></span> 4
                        </div>
                        <div class="col-xs-7 col-md-8">
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_four_star*100)/$count_product_star .'%' }}">
                                    <span class="sr-only">{{ ($count_four_star*100)/$count_product_star .'%' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1 col-md-1">
							<span class="badge badge-dark badge-pill">{{ $count_four_star }}</span>
						</div>
                        <!-- end 4 -->

                        <div class="col-xs-2 col-md-2 text-right">
                            <span><i class="fa fa-star text-info"></i></span> 3
                        </div>
                        <div class="col-xs-7 col-md-8">
                            <div class="progress">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_three_star*100)/$count_product_star .'%' }}">
                                    <span class="sr-only">{{ ($count_three_star*100)/$count_product_star .'%' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1 col-md-1">
							<span class="badge badge-dark badge-pill">{{ $count_three_star }}</span>
						</div>
                        <!-- end 3 -->

                        <div class="col-xs-2 col-md-2 text-right">
                            <span><i class="fa fa-star text-info"></i></span> 2
                        </div>
                        <div class="col-xs-7 col-md-8">
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_two_star*100)/$count_product_star .'%' }}">
                                    <span class="sr-only">{{ ($count_two_star*100)/$count_product_star .'%' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1 col-md-1">
							<span class="badge badge-dark badge-pill">{{ $count_two_star }}</span>
						</div>
                        <!-- end 2 -->

                        <div class="col-xs-2 col-md-2 text-right">
                            <span><i class="fa fa-star text-info"></i></span> 1
                        </div>
                        <div class="col-xs-7 col-md-8">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                    aria-valuemin="0" aria-valuemax="100" style="width: {{ ($count_one_star*100)/$count_product_star .'%' }}">
                                    <span class="sr-only">{{ ($count_one_star*100)/$count_product_star .'%' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-1 col-md-1">
							<span class="badge badge-dark badge-pill">{{ $count_one_star }}</span>
						</div>
                        <!-- end 1 -->

                    </div>
                    <!-- end row -->
                </div>
                @foreach($product_star as $pro_sta)
				<div class="col-12 mt-2 mb-2 text-dark">
					<span class="font-weight-bolder"><span class="m-3"><i class="fa fa-user"></i></span> {{ $pro_sta->Customer->name }}</span>
						<br>
					<span class="font-italic pl-5">{{ $pro_sta->content }}</span>
				</div>
				@endforeach
                @else
                <div class="col-12">
                	<span class="font-weight-bolder font-italic">Sản phẩm chưa được đánh giá</span>
                </div>
                @endif
            </div> 
            @if($check_received_product)
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page"><span><i class="fa fa-edit"></i> Đánh giá sản phẩm</span></li>
	                    </ol>
	                </nav>                
	            </div>
	            <div class="col-12">
	            	<form id="review_form">
	            		<div class=" text-center "> 
	            			<label class="radio-inline fa fa-star" style="font-size: 30px;"> 
						      	<input type="radio" name="number_star" value="1">
						    </label>
						    <label class="radio-inline fa fa-star" style="font-size: 30px;"> 
						      	<input type="radio" name="number_star" value="2">
						    </label>
						    <label class="radio-inline fa fa-star" style="font-size: 30px;"> 
						      	<input type="radio" name="number_star" value="3">
						    </label>
						    <label class="radio-inline fa fa-star" style="font-size: 30px;"> 
						      	<input type="radio" name="number_star" value="4">
						    </label>
						    <label class="radio-inline fa fa-star" style="font-size: 30px;"> 
						      	<input type="radio" name="number_star" value="5" checked>
						    </label>
	            		</div>
		            	<div class="form-group">
		            		<textarea name="content" id="content" rows="3" class="form-control" required></textarea>
		            	</div>
		            	<button type="submit" class="form-control btn btn-dark" value="">Send Reviews</button>
		            </form>
	            </div>
			</div>
			@endif
			<div class="row mt-4">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Comments</li>
	                    </ol>
	                </nav>                
	            </div>
	            <div class="col-12">
	            	<form action="" method="POST" id="comment_form">
		            	<div class="form-group">
		            		<textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
		            	</div>
		            	<button type="submit" class="form-control btn btn-dark" value="">Send Comment</button>
		            </form>
		            <input type="hidden" id="product_id" value="{{ $product->id }}"> 
	            </div>
	            <div class="m-2" id="view_product_comments">
	            	@foreach($product_comment as $pro_com)
					<div class="col-12 mt-2 mb-2 text-dark">
						<span class="font-weight-bolder"><span class="m-3"><i class="fa fa-user"></i></span> {{ $pro_com->Customer->name }}</span>
							<br>
						<span class="font-italic pl-5">{{ $pro_com->content }}</span>
					</div>
					@endforeach
	            </div>
			</div>
			<div class="row mt-5">
				<div class="col-12">
	                <nav aria-label="breadcrumb" class="font-weight-bolder">
	                    <ol class="breadcrumb">
	                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">Related Products</li>
	                    </ol>
	                </nav>                
	            </div>
	            @foreach($product_related as $pro_rel)
	            <div class="col-md-6 col-lg-4 mt-4">
	                <div class="card text-dark">
	                    <a href="product.html/{{ $pro_rel->id }}-{{ $pro_rel->slug }}"><img class="card-img-top img-thumbnail" src="assets/uploads/products/thumbnail/{{ $pro_rel->thumbnail }}" alt=""></a>
	                    <div class="card-body">
	                        <span class="card-title font-weight-bolder text-dark">
	                            {{ $pro_rel->name }}
	                        </span>
	                        <br>
	                        @if($pro_rel->discount_price != null && $pro_rel->discount_price != 0)
	                        <span class="font-italic text-dark">{{ $pro_rel->discount_price }}</span> <span class="font-italic text-dark" style="text-decoration: line-through;">{{ $pro_rel->price }}</span>
	                        @else
	                        <span class="font-italic text-dark">{{ $pro_rel->price }}</span>
	                        @endif
	                        
	                    </div>

	                    <div class="card-footer bg-dark">
	                        <div class="row">
	                            <a href="product.html/{{ $pro_rel->id }}-{{ $pro_rel->slug }}"><button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-link"></i></span></button></a>
	                            <button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-eye"></i></span></button>
	                            <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $pro_rel->id }}"><span><i class="fa fa-cart-plus"></i></span></button>
	                        </div>
	                    </div>
	                    <div class="card-footer bg-dark">
	                        <div class="row">
	                            @php
	                            $star = $pro_rel->star;
	                            $star_round = round($star);
	                            @endphp
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
	                            <div class="col-2 text-light">
	                                <span><i class="fa fa-comments text-light"><span></i><br><span class="font-weight-bolder">{{ $pro_rel->count_review }}</span>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            @endforeach
			</div>
		</div>
		<div class="col-md-3">
			<div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="font-weight-bolder ">
                        <ol class="breadcrumb  bg-dark">
                            <li class="breadcrumb-item active text-light" aria-current="page">Featured Products</li>
                        </ol>
                    </nav>                
                </div>
            </div>
			<div class="row">
	            @foreach($product_featured as $pro_fea)
	            <div class="col-12 mt-4">
	                <div class="card text-dark">
	                    <a href="product.html/{{ $pro_fea->id }}-{{ $pro_fea->slug }}"><img class="card-img-top img-thumbnail" src="assets/uploads/products/thumbnail/{{ $pro_fea->thumbnail }}" alt=""></a>
	                    <div class="card-body">
	                        <span class="card-title font-weight-bolder text-dark">
	                            {{ $pro_fea->name }}
	                        </span>
	                        <br>
	                        @if($pro_fea->discount_price != null && $pro_fea->discount_price != 0)
	                        <span class="font-italic text-dark">{{ $pro_fea->discount_price }}</span> <span class="font-italic text-dark" style="text-decoration: line-through;">{{ $pro_fea->price }}</span>
	                        @else
	                        <span class="font-italic text-dark">{{ $pro_fea->price }}</span>
	                        @endif
	                        
	                    </div>

	                    <div class="card-footer bg-dark">
	                        <div class="row">
	                            <a href="product.html/{{ $pro_fea->id }}-{{ $pro_fea->slug }}"><button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-link"></i></span></button></a>
	                            <button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-eye"></i></span></button>
	                            <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $pro_fea->id }}"><span><i class="fa fa-cart-plus"></i></span></button>
	                        </div>
	                    </div>
	                    <div class="card-footer bg-dark">
	                        <div class="row">
	                            @php
	                            $star = $pro_fea->star;
	                            $star_round = round($star);
	                            @endphp
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
	                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
	                            <div class="col-2 text-light">
	                                <span><i class="fa fa-comments text-light"><span></i><br><span class="font-weight-bolder">{{ $pro_fea->count_review }}</span>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            @endforeach
	        </div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	$(document).ready(function(){
		$('#comment_form').on('submit', function(event){
			event.preventDefault();
			check_user_login = $('#check_user_login').val();
			console.log(check_user_login);
			if(check_user_login == '0')
			{
				toastr.error("Bạn phải đăng nhập mới bình luận được !", 'Response',{timeOut: 200});
			}
			else
			{
				data_comment = $(this).serializeArray();
				$.each(data_comment, function(key, value){
					comment = value.value;
				});
				var product_id = $('#product_id').val();
				$.ajax({
					url : 'send_comment_product.html',
					type : 'POST',
					data : {
						comment : comment,
						product_id : product_id
					},
					dataType : 'text',
					success : function(result){
						$('#comment').val('');
						toastr.success(result, 'Response',{timeOut: 400});
						setTimeout("location.reload(true);",400);
					}
				});
			}
		});
		$('#review_form').on('submit', function(event){
			event.preventDefault();
			data_review = $(this).serializeArray();
			data = [];
			$.each(data_review, function(key, value){
				data[value.name] = value.value;
			});
			number_star = data['number_star'];
			content = data['content'];
			var product_id = $('#product_id').val();
			$.ajax({
				url : 'send_review_product.html',
				type : 'POST',
				data : {
					content : content,
					product_id : product_id,
					number_star : number_star
				},
                dataType: 'JSON',
				success : function(result){
					if(result.res_type == 'success')
                    {
                        toastr.success(result.response, 'Response');
                        setTimeout("location.reload(true);",500);
                    }
				}
			});
		});
	});
</script>
@endpush

