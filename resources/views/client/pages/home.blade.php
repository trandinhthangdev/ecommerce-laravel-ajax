@extends('client.layouts.master')

@section('title', 'Home')

@section('content')

    <!-- Begin Slider -->
    <div class="container">
        <div class="slider">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @php
                    $index = 0;
                    @endphp
                    @foreach($home_slider as $slider)
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
                    @foreach($home_slider as $slider)
                    @if($index == 0)
                    <div class="carousel-item active">
                        @if($slider->link != null)
                            <a href="{{ $slider->link }}"><img src="assets/uploads/sliders/{{ $slider->image }}" style="height: 100%; width: 100%" class="img-responsive"></a>
                        @else
                            <img src="assets/uploads/sliders/{{ $slider->image }}" style="height: 100%; width: 100%" class="img-responsive">
                        @endif
                        <div class="carousel-caption">
                            <h3>{{ $slider->description }}</h3>
                        </div>
                    </div>
                    @else
                    <div class="carousel-item">
                        @if($slider->link != null)
                            <a href="{{ $slider->link }}"><img src="assets/uploads/sliders/{{ $slider->image }}" style="width: 100%; height: 100%;"></a>
                        @else
                            <img src="assets/uploads/sliders/{{ $slider->image }}" style="height: 100%; width: 100%" class="img-responsive">
                        @endif
                        <div class="carousel-caption">
                            <h3>{{ $slider->description }}</h3>
                        </div>
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

    <!-- Begin Featured Categories -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder ">
                    <ol class="breadcrumb  bg-dark">
                        <li class="breadcrumb-item active text-light" aria-current="page">Featured Categories</li>
                    </ol>
                </nav>                
            </div>
        </div>
        <div class="row p-3">
            @foreach($category_featured as $cat_fea)
            <div class="col-lg-4 col-md-6 mb-4 text-center p-5 border border-dark" style="background-image: url('assets/uploads/categories/image/{{ $cat_fea->image  }}'); background-position: center; background-size: cover; background-color: black; opacity: 0.6;">
                <button class="btn btn-dark mb-2"><span><i class="fa fa-link"></i></span></button>
                <br>
                <span class="font-weight-bolder text-dark">{{ $cat_fea->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Featured Categories -->

    <!-- Begin Featured Products -->
    <div class="container">
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
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
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
                            <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $pro_fea->id }}><span><i class="fa fa-cart-plus"></i></span></button>
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
    <!-- End Featured Products -->  

    <!-- Begin Recently Added --> 
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder ">
                    <ol class="breadcrumb  bg-dark">
                        <li class="breadcrumb-item active text-light" aria-current="page">Recently Added</li>
                    </ol>
                </nav>                
            </div>
        </div>
        <div class="row">
            @foreach($product_recently_added as $pro_rec_add)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card text-dark">
                    <a href="product.html/{{ $pro_rec_add->id }}-{{ $pro_rec_add->slug }}"><img class="card-img-top img-thumbnail" src="assets/uploads/products/thumbnail/{{ $pro_rec_add->thumbnail }}" alt=""></a>
                    <div class="card-body">
                        <span class="card-title font-weight-bolder text-dark">
                            {{ $pro_rec_add->name }}
                        </span>
                        <br>
                        @if($pro_rec_add->discount_price != null && $pro_rec_add->discount_price != 0)
                        <span class="font-italic text-dark">{{ $pro_rec_add->discount_price }}</span> <span class="font-italic text-dark" style="text-decoration: line-through;">{{ $pro_rec_add->price }}</span>
                        @else
                        <span class="font-italic text-dark">{{ $pro_rec_add->price }}</span>
                        @endif
                    </div>

                    <div class="card-footer bg-dark">
                        <div class="row">
                            <a href="product.html/{{ $pro_rec_add->id }}-{{ $pro_rec_add->slug }}"><button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-link"></i></span></button></a>
                            <button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-eye"></i></span></button>
                            <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $pro_rec_add->id }}"><span><i class="fa fa-cart-plus"></i></span></button>
                        </div>
                    </div>
                    <div class="card-footer bg-dark">
                        <div class="row">
                            @php
                            $star = $pro_rec_add->star;
                            $star_round = round($star);
                            @endphp
                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
                            <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
                            <div class="col-2 text-light">
                                <span><i class="fa fa-comments text-light"><span></i><br><span class="font-weight-bolder">{{ $pro_rec_add->count_review }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Recently Added -->
    
    <!-- Begin Last News -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb" class="font-weight-bolder">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Last News</li>
                    </ol>
                </nav>                
            </div>
        </div>
        <div class="row">
            @foreach($last_news as $las_new)
            <div class="col-md-12 col-lg-6 mb-2">
                <div class="row">
                    <div class="col-4 pt-2">
                        <a href=""><img src="assets/uploads/news/image/{{ $las_new->image }}" class="w-100" alt=""></a> 
                    </div>
                    <div class="col-8">
                        <a href="" class="text-decoration-none"><span class="text-dark font-weight-bolder">{{ $las_new->title }}</span></a>
                        <br>
                        <small class="text-secondary font-italic">{{ $las_new->description }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- End Last News -->
@endsection

@push('script')

@endpush
