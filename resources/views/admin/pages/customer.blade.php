@extends('admin.layouts.master')

@section('title', 'Customer')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Customer</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Create At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->User->email }}</td>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->address }}</td>
                            <td>{{ $value->phone }}</td>
                            <td>{{ $value->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center">
                {{ $customer->links() }}
            </div>
        </div>  
    </div>
@endsection

@push('script')

@endpush
