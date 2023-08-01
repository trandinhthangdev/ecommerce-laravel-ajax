@extends('admin.layouts.master')

@section('title', 'Category')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Category</span>
        </div>
    </div>
    <div class="container">
        <div class="col-12 text-right mb-3">
            <button class="btn btn-dark" id="add_category_btn" data-toggle="modal" data-target="#add_category_modal"><span><i class="fa fa-plus"></i></span></button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Featured</th>
                    <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                </tr>
            </thead>
            <tbody>
                @if(count($category))
                @foreach($category as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>
                        <img src="assets/uploads/categories/image/{{ $value->image }}" alt="" style="width: 100px;">
                    </td>
                    <td class="text-center">
                        @if($value->status)
                        <button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-check"></i></span></button>
                        @else
                        <button class="btn btn-secondary btn-sm mb-2"><span><i class="fa fa-close"></i></span></button>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($value->featured)
                        <button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-check"></i></span></button>
                        @else
                        <button class="btn btn-secondary btn-sm mb-2"><span><i class="fa fa-close"></i></span></button>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="admin/{{ $value->slug }}-{{ $value->id }}/brand"><button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-eye"></i></span></button></a>
                        <button class="btn btn-dark btn-sm mb-2 edit_category_btn" data-toggle="modal" data-target="#edit_category_modal" data-id="{{ $value->id }}"><span><i class="fa fa-edit"></i></span></button>
                        <button class="btn btn-dark btn-sm mb-2 delete_category_btn" data-toggle="modal" data-target="#delete_category_modal" data-id="{{ $value->id }}"><span><i class="fa fa-trash"></i></span></button>
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
        <div>{{ $category->links() }}</div>
    </div>

        <!-- Add Catgory Modal -->
    <div class="modal" id="add_category_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add_category_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                            <div id="name_error_add">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <select name="featured" class="form-control" id="featured">
                                <option value="0">Unfeatured</option>
                                <option value="1">Featured</option>
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

    <!-- Edit Category Modal -->
    <div class="modal" id="edit_category_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_category_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name_edit" placeholder="Enter name" name="name" required>
                            <div id="name_error_edit">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*" >
                            <div id="image_old" class="mt-2">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status_edit">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <select name="featured" class="form-control" id="featured_edit">
                                <option value="0">Unfeatured</option>
                                <option value="1">Featured</option>
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

    <!-- Delete Category Modal-->
    <div class="modal" id="delete_category_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Do you want to delete this category ?</h4>
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
        $(document).on('click', '#add_category_btn', function(){
            $('#add_category_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/category',
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

        $(document).on('click', '.edit_category_btn', function(){
            id = $(this).data('id');
            $.ajax({
                url : 'admin/category/' + id + '/edit',
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    $('#name_edit').val(result.name);
                    image_html = '<img src="assets/uploads/categories/image/' + result.image + '" alt="" style="width: 100px;">';
                    $('#image_old').html(image_html);
                    $('#status_edit').val(result.status);
                    $('#featured_edit').val(result.featured);
                }
            });
            $('#edit_category_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/category/update/' + id,
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

        $(document).on('click', '.delete_category_btn', function(){
            id = $(this).data('id');
            $(document).on('click', '.delete-yes', function(){
                $.ajax({
                    url : 'admin/category/' + id,
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