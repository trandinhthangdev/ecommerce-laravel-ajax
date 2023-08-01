@extends('client.layouts.master')

@section('title', 'Contact')

@section('content')
<div class="container mt-4">
    <h2 class="font-weight-bolder text-center text-dark">Contact Us</h2>
    <form action="" method="POST" id="contact_form">
        <div class="form-group">
            <label for="message" class="font-weight-bolder text-dark">Message</label>
            <textarea class="form-control" rows="24" name="message" id="message" required></textarea>
        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
            	@if(Auth::check() && Auth::user()->role == 0)
					@php
		            $check = 1;
		            @endphp
	            @else
		            @php
		            $check = 0;
		            @endphp
	            @endif
                <button type="submit" class="btn btn-dark form-control font-weight-bolder" id="contact_btn" value="{{ $check }}">Send Us</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function(){
        $('#contact_form').on('submit', function(event){
            event.preventDefault();
            var check = $('#contact_btn').val();
            if(check != 0)
            {
                var data_contact = $(this).serializeArray();
                $.each(data_contact, function(key, value){
                    message = value.value;
                });
               
                $.ajax({
                    url : 'contact_post.html',
                    type : 'POST',
                    data : {
                        message : message
                    },
                    dataType : 'text',
                    success : function(result){
                        $('#message').val('');
                        toastr.success(result, 'Response',{timeOut: 200});
                    }
                });
            }
            else
            {
                toastr.error("Bạn chưa đăng nhập, Bạn không thể gửi cho chúng tôi !", 'Response',{timeOut: 200});
            }
            
        });
    });
</script>
@endpush

