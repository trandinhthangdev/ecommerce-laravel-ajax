@extends('admin.layouts.master')

@section('title', 'Admin')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Admin</span>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admin as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center">
                {{ $admin->links() }}
            </div>
        </div>  
    </div>
@endsection

@push('script')

@endpush
