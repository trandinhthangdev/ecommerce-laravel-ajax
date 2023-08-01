@extends('client.layouts.master')

@section('title')
	{{ $news->title }}
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9 mt-4">
			<div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder">
                    <ol class="breadcrumb">
                        <li class=" text-dark font-weight-bolder breadcrumb-item active" aria-current="page">
                        	{{ $news->title }}
                        </li>
                    </ol>
                </nav>                
            </div>
            <div class="row text-dark">
            	<div class="col-12 overflow-hidden">
            		{!! $news->content !!}
            	</div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="col-12">
			    <ul class="list-inline">
			        <li class="list-inline-item text-info mr-5"><span><i class="fa fa-eye"></i></span><span id="count_views"></span> {{ $news->view }} Views</li>
			        <li class="list-inline-item text-success"><span><i class="fa fa-comments"></i></span><span id="count_comments"></span> {{ count($news_comment) }} Comments</li>
			    </ul>
            </div>

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
		            <input type="hidden" id="news_id" value="{{ $news->id }}"> 
	            </div>
	            <div class="m-2">
	            	@foreach($news_comment as $new_com)
					<div class="col-12 mt-2 mb-2 text-dark">
						<span class="font-weight-bolder"><span class="m-3"><i class="fa fa-user"></i></span> {{ $new_com->Customer->name }}</span>
							<br>
						<span class="font-italic pl-5">{{ $new_com->content }}</span>
					</div>
					@endforeach
	            </div>
			</div>
   		</div>
		<div class="col-md-3 mt-4">
			<div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="font-weight-bolder ">
                        <ol class="breadcrumb  bg-dark">
                            <li class="breadcrumb-item active text-light" aria-current="page">Popular News</li>
                        </ol>
                    </nav>                
                </div>
            </div>
			<div class="row">
	            @foreach ($popular_news as $pop_new)
	            <div class="col-12 mb-5">
                        <a href="news.html/{{ $pop_new->id }}-{{ $pop_new->slug }}"><img src="assets/uploads/news/image/{{ $pop_new->image }}" class="w-100" alt=""></a> 
                        <a href="news.html/{{ $pop_new->id }}-{{ $pop_new->slug }}" class="text-decoration-none"><small class="text-dark font-weight-bolder">{{ $pop_new->title }}</small></a>
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
				var news_id = $('#news_id').val();
				$.ajax({
					url : 'send_comment_news.html',
					type : 'POST',
					data : {
						comment : comment,
						news_id : news_id
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
	});
</script>
@endpush
