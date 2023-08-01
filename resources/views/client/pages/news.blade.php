@extends('client.layouts.master')

@section('title', 'News')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="font-weight-bolder ">
                            <ol class="breadcrumb  bg-dark">
                                <li class="breadcrumb-item active text-light" aria-current="page">Last News</li>
                            </ol>
                        </nav>                
                    </div>
                </div>
                <div class="row">
            		@if(count($last_news))
                	@foreach($last_news as $las_new)
                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-4 pt-2">
                                <a href="news.html/{{ $las_new->id }}-{{ $las_new->slug }}"><img src="assets/uploads/news/image/{{ $las_new->image }}" class="w-100" alt=""></a> 
                            </div>
                            <div class="col-8">
                                <a href="news.html/{{ $las_new->id }}-{{ $las_new->slug }}" class="text-decoration-none"><span class="text-dark font-weight-bolder">{{ $las_new->title }}</span></a>
                                <br>
                                <small class="text-secondary font-italic">{{ $las_new->description }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-danger" role="alert">
	                    Not Data
	                </div>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb" class="font-weight-bolder ">
                            <ol class="breadcrumb  bg-dark">
                                <li class="breadcrumb-item active text-light" aria-current="page">Featured News</li>
                            </ol>
                        </nav>                
                    </div>
                </div>
                <div class="row">
                	@foreach($featured_news as $fea_new)
                    <div class="col-12 mb-5">
                        <a href="news.html/{{ $fea_new->id }}-{{ $fea_new->slug }}"><img src="assets/uploads/news/image/{{ $fea_new->image }}" class="w-100" alt=""></a> 
                        <a href="news.html/{{ $fea_new->id }}-{{ $fea_new->slug }}" class="text-decoration-none"><small class="text-dark font-weight-bolder">{{ $fea_new->title }}</small></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
