@extends('admin.layouts.master')

@section('title', 'Contact')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Contact</span>
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
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contact as $key => $value)
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
                            <td>{{ $value->message }}</td>
                            <td>{{ $value->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
                {{ $contact->links() }}
            </div>
        </div>  
    </div>
@endsection

@push('script')

@endpush
