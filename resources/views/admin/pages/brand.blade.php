@extends('admin.layouts.master')

@section('title')
    {{ $category->name }} - Brand
@endsection


@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">{{ $category->name }}</span>
            <input type="hidden" id="category_id" value="{{ $category->id }}">
            <span class="text-light">Brand</span>
        </div>
    </div>
    <div class="container">
        <div class="col-12 text-right mb-3">
            <button class="btn btn-dark" id="add_brand_btn" data-toggle="modal" data-target="#add_brand_modal"><span><i class="fa fa-plus"></i></span></button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                </tr>
            </thead>
            <tbody>
                @if(count($brand))
                @foreach($brand as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td class="text-center">
                        @if($value->status)
                        <button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-check"></i></span></button>
                        @else
                        <button class="btn btn-secondary btn-sm mb-2"><span><i class="fa fa-close"></i></span></button>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="admin/{{ $category->slug }}-{{ $category->id }}/{{ $value->slug }}-{{ $value->id }}/product"><button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-eye"></i></span></button></a>
                        <button class="btn btn-dark btn-sm mb-2 edit_brand_btn" data-toggle="modal" data-target="#edit_brand_modal" data-id="{{ $value->id }}"><span><i class="fa fa-edit"></i></span></button>
                        <button class="btn btn-dark btn-sm mb-2 delete_brand_btn" data-toggle="modal" data-target="#delete_brand_modal" data-id="{{ $value->id }}"><span><i class="fa fa-trash"></i></span></button>
                    </td>
                </tr>
                @endforeach
                @else 
                <tr>
                    <td>Not Data</td>
                </tr>  
                @endif
            </tbody>
        </table>
        <div>{{ $brand->links() }}</div>
    </div>

        <!-- Add Brand Modal -->
    <div class="modal" id="add_brand_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Brand</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add_brand_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                            <div id="name_error_add">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Brand Modal -->
    <div class="modal" id="edit_brand_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Brand</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_brand_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
                            <div id="name_error_edit">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">Save</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Delete Brand Modal-->
    <div class="modal" id="delete_brand_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Do you want to delete this brand ?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body text-center">
                    <button type="button" class="btn btn-dark delete-yes">Yes</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function(){
            $(document).on('click', '#add_brand_btn', function(){
                $('#add_brand_form').on('submit',function(event){
                    category_id = $('#category_id').val();
                    event.preventDefault();
                    $.ajax({
                        url : 'admin/' + category_id + '/brand',
                        data: new FormData(this),
                        type: 'POST',
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(result){
                            if(result.res_type == 'error')
                            {
                                html = '';
                                html += '<div class="alert alert-danger" role="alert">';
                                    html += result.response.name[0];
                                html += '</div>';
                                $('#name_error_add').html(html);
                            }
                            else if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response');
                                setTimeout("location.reload(true);",500);
                            }
                        }
                    });
                });
                
            });

            $(document).on('click', '.edit_brand_btn', function(){
                id = $(this).data('id');
                console.log()
                $.ajax({
                    url : 'admin/brand/' + id + '/edit',
                    type : 'GET',
                    dataType : 'JSON',
                    success : function(result){
                        $('#name').val(result.name);
                        $('#status').val(result.status);
                    }
                });
                $('#edit_brand_form').on('submit', function(event){
                    category_id = $('#category_id').val();
                    event.preventDefault();
                    $.ajax({
                        url : 'admin/' + category_id + '/brand/update/' + id,
                        data: new FormData(this),
                        type: 'POST',
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success : function(result){
                            
                            if(result.res_type == 'error')
                            {
                                html = '';
                                html += '<div class="alert alert-danger" role="alert">';
                                    html += result.response.name[0];
                                html += '</div>';
                                $('#name_error_edit').html(html);
                            }
                            else if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response');
                                setTimeout("location.reload(true);",500);
                            }
                        } 
                    });
                });
            });

            $(document).on('click', '.delete_brand_btn', function(){
                id = $(this).data('id');
                $(document).on('click', '.delete-yes', function(){
                    $.ajax({
                        url : 'admin/brand/' + id,
                        type : 'DELETE',
                        dataType : 'JSON',
                        success : function(result){
                            if(result.res_type == 'success')
                            {
                                toastr.success(result.response, 'Response');
                                setTimeout("location.reload(true);",500);
                            }
                        }
                    });
                });
            });
        });
    </script>
@endpush