@extends('admin.layouts.master')

@section('title', 'Slider')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">Slider</span>
        </div>
    </div>
    <div class="container">
        <div class="col-12 text-right mb-3">
            <button class="btn btn-dark" data-toggle="modal" data-target="#add_slider_modal" id="add_slider_btn"><span><i class="fa fa-plus"></i></span></button>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                </tr>
            </thead>
            <tbody>
                @if(count($home_slider))
                @foreach($home_slider as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->description }}</td>
                    <td>
                        <img src="assets/uploads/sliders/{{ $value->image }}" alt="" style="width: 100px;">
                    </td>
                    <td>
                        {{ $value->link }}
                    </td>
                    <td class="text-center">
                        @if($value->status)
                        <button class="btn btn-dark btn-sm mb-2"><span><i class="fa fa-check"></i></span></button>
                        @else
                        <button class="btn btn-secondary btn-sm mb-2"><span><i class="fa fa-close"></i></span></button>
                        @endif
                    </td>
                    <td class="text-center">
                        <button class="btn btn-dark btn-sm mb-2 edit_slider_btn" data-toggle="modal" data-target="#edit_slider_modal" data-id="{{ $value->id }}"><span><i class="fa fa-edit"></i></span></button>
                        <button class="btn btn-dark btn-sm mb-2 delete_slider_btn" data-toggle="modal" data-target="#delete_slider_modal" data-id="{{ $value->id }}"><span><i class="fa fa-trash"></i></span></button>
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
        <div>{{ $home_slider->links() }}</div>
    </div>

    <!-- Add Slider Modal -->
    <div class="modal" id="add_slider_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Slider</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add_slider_form">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" placeholder="Enter description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" placeholder="Enter link" name="link">
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

    <!-- Edit Slider Modal -->
    <div class="modal" id="edit_slider_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Slider</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_slider_form">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" placeholder="Enter description" name="description">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                            <div id="image_old">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" placeholder="Enter link" name="link">
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

    <!-- Delete Slider Modal-->
    <div class="modal" id="delete_slider_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Do you want to delete this slider ?</h4>
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
        $(document).on('click', '#add_slider_btn', function(){
            $('#add_slider_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/slider',
                    data: new FormData(this),
                    type: 'POST',
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData:false,
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

        $(document).on('click', '.edit_slider_btn', function(){
            id = $(this).data('id');
            $.ajax({
                url : 'admin/slider/' + id + '/edit',
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    $('#description').val(result.description);
                    image_html = '<img src="assets/uploads/sliders/' + result.image + '" alt="" style="width: 100px;" class="img-thumbnail">';
                    $('#image_old').html(image_html);
                    $('#link').val(result.link);
                    $('#status').val(result.status);
                }
            });
            $('#edit_slider_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/slider/update/' + id,
                    data: new FormData(this),
                    type: 'POST',
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData:false,
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

        $(document).on('click', '.delete_slider_btn', function(){
            id = $(this).data('id');
            $(document).on('click', '.delete-yes', function(){
                $.ajax({
                    url : 'admin/slider/' + id,
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