@extends('client.layouts.master')

@section('title')
	{{ $category_one->name }} - {{ $brand_one->name }}
@endsection

@section('content')
<div class="container mt-2">
    <div class="jumbotron bg-dark text-center">
        <span class="text-light h2">{{ $category_one->name }}</span>
        <span class="text-light">{{ $brand_one->name }}</span>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 mb-4">
        	@include('client.layouts.sidebar-product')
        </div>
        <div class="col-lg-9 col-md-8">
            <div class="row">
                @if(count($brand_product))
                @foreach($brand_product as $bra_pro)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-dark">
                        <a href="product/{{ $bra_pro->id }}-{{ $bra_pro->slug }}"><img class="card-img-top img-thumbnail" src="assets/uploads/products/thumbnail/{{ $bra_pro->thumbnail }}" alt=""></a>
                        <div class="card-body">
                            <span class="card-title font-weight-bolder text-dark">
                                {{ $bra_pro->name }}
                            </span>
                            <br>
                            @if($bra_pro->discount_price != null && $bra_pro->discount_price != 0)
                            <span class="font-italic text-dark">{{ $bra_pro->discount_price }}</span> <span class="font-italic text-dark" style="text-decoration: line-through;">{{ $bra_pro->price }}</span>
                            @else
                            <span class="font-italic text-dark">{{ $bra_pro->price }}</span>
                            @endif
                            
                        </div>

                        <div class="card-footer bg-dark">
                            <div class="row">
                                <a href="product/{{ $bra_pro->id }}-{{ $bra_pro->slug }}"><button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-link"></i></span></button></a>
                                <button class="btn btn-dark btn-sm col-4"><span><i class="fa fa-eye"></i></span></button>
                                <button class="btn btn-dark btn-sm col-4" id="cart_product_id" value="{{ $bra_pro->id }}"><span><i class="fa fa-cart-plus"></i></span></button>
                            </div>
                        </div>
                        <div class="card-footer bg-dark">
                            <div class="row">
                                @php
                                $star = $bra_pro->star;
                                $star_round = round($star);
                                @endphp
                                <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                                <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                                <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"></i><span></div>
                                <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
                                <div class="col-2"><span><i class="fa fa-star {{ ($star >= 1) ? 'text-light' : 'text-secondary' }}"><span></i></div>
                                <div class="col-2 text-light">
                                    <span><i class="fa fa-comments text-light"><span></i><br><span class="font-weight-bolder">{{ $bra_pro->count_review }}</span>
                                </div>
                            </div>
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
            <div class="row">
                <div class="col-12">
                    {{ $brand_product->links() }}
                </div>
            </div>       
        </div>
    </div>
</div>
@endsection

@push('script')

@endpush
