@extends('admin.layouts.master')

@section('title', 'Product Comment')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Product Comment</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Customer</th>
                            <th>Content</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product_comment as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->Customer->name }}</td>
                            <td>{{ $value->content }}</td>
                            <td>{{ $value->Product->name }}</td>
                            <td>{{ $value->created_at }}</td>
                            <td class="text-center">
                                <a href="product/{{ $value->Product->id }}-{{ $value->Product->slug }}" target="_blank"><button class="btn btn-dark btn-sm mb-2" data-toggle="modal" data-target="#view_product_modal"><span><i class="fa fa-eye"></i></span></button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                {{ $product_comment->links() }}
            </div>
        </div>  
    </div>
@endsection

@push('script')

@endpush