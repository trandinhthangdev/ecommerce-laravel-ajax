@extends('admin.layouts.master')

@section('title', 'Check Out')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Checkout</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Info Customer</th>
                            <th>Order Detail</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($check_out as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <span class="font-weight-bolder">Name</span><br>
                                <span class="font-italic">{{ $value->Customer->name }}</span>
                                <div class="dropdown-divider"></div>
                                <span class="font-weight-bolder">Address</span><br>
                                <span class="font-italic">{{ $value->Customer->address }}</span>
                                <div class="dropdown-divider"></div>
                                <span class="font-weight-bolder">Phone</span><br>
                                <span class="font-italic">{{ $value->Customer->phone }}</span>
                            </td>
                            <td>
                                {!! $value->order_detail !!}                                
                            </td>
                            <td>{{ $value->created_at }}</td>
                            <td class="text-center">
                                @if($value->status)
                                <button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-check"></i></span></button>
                                @else
                                <button class="btn btn-secondary btn-sm mb-2"><span><i class="fa fa-close"></i></span></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                {{ $check_out->links() }}
            </div>
        </div>  
    </div>

@endsection

@push('script')

@endpush

