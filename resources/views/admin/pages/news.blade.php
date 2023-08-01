@extends('admin.layouts.master')

@section('title', 'News')

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">News</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-right mb-3">
                <button class="btn btn-dark" data-toggle="modal" data-target="#add_news_modal" id="add_news_btn"><span><i class="fa fa-plus"></i></span></button>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th class="text-center">
                                <span><i class="fa fa-info-circle"></i></span>
                            </th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($news))
                        @foreach($news as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ $value->description }}</td>
                            <td>
                                <button class="btn btn-dark btn-sm mb-2 info_news_btn" data-toggle="modal" data-target="#info_news_modal" data-id="{{ $value->id }}"><span><i class="fa fa-eye"></i></span></button>
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
                                <button class="btn btn-dark btn-sm mb-2 view_news_btn" data-toggle="modal" data-target="#view_news_modal" data-id="{{ $value->id }}"><span><i class="fa fa-eye"></i></span></button>
                                <button class="btn btn-dark btn-sm mb-2 edit_news_btn" data-toggle="modal" data-target="#edit_news_modal" data-id="{{ $value->id }}"><span><i class="fa fa-edit"></i></span></button>
                                <button class="btn btn-dark btn-sm mb-2 delete_news_btn" data-toggle="modal" data-target="#delete_news_modal" data-id="{{ $value->id }}"><span><i class="fa fa-trash"></i></span></button>
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
                <div>{{ $news->links() }}</div>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-dark"><span><i class="fa fa-spinner"></i></span></button>
            </div>
        </div>  
    </div>

    <!-- Info News Modal -->
    <div class="modal" id="info_news_modal">
        <div class="modal-dialog" style="min-width: 80%; margin: auto; min-height: 75vh;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Info News</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <span class="font-weight-bolder">Image</span><br>
                    <div id="info_news_image">
                        
                    </div>

                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Views</span><br>
                    <span class="font-italic" id="info_news_view"></span>

                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Content</span><br>
                    <div class="overflow-auto" id="info_news_content">
                        
                    </div>
                    
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- View News Modal -->
    <div class="modal" id="view_news_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">View News</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div id="view_product_iframe">
                        <iframe src=""></iframe>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- Add News Modal -->
    <div class="modal" id="add_news_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add News</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add_news_form">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" placeholder="Enter title" name="title" required>
                            <div id="name_error_title">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content_add" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="featured">Featured</label>
                            <select name="featured" class="form-control">
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

    <!-- Edit News Modal -->
    <div class="modal" id="edit_news_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit News</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_news_form">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" placeholder="Enter title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content" name="content" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control-file" id="image" accept="image/*" name="image">
                            <div id="old_news_image">
                                
                            </div>
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

    <!-- Delete News Modal-->
    <div class="modal" id="delete_news_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Do you want to delete this news ?</h4>
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script type="text/javascript">
        CKEDITOR.replace('content_add');
        CKEDITOR.replace('content');
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $(document).on('click', '#add_news_btn', function(){
            $('#add_news_form').on('submit',function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/news',
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
                                html += result.response.title[0];
                            html += '</div>';
                            $('#name_error_title').html(html);
                        }
                        else if(result.res_type == 'success')
                        {
                            toastr.success(result.response, 'Response');
                            setTimeout("location.reload(true);",500);
                        }
                        console.log(result);
                    }
                });
            });
            
        });

        $(document).on('click', '.info_news_btn', function(){
            id = $(this).data('id');
            console.log(id);
            $.ajax({
                url : 'admin/news/' + id,
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    $('#info_news_image').html('<img src="assets/uploads/news/image/' + result.image + '" alt="" style="width: 100px;" class="img-thumbnail">');
                    $('#info_news_content').html(result.content);
                    $('#info_news_view').html(result.view);
                }
            });
        });

        $(document).on('click', '.edit_news_btn', function(){
            id = $(this).data('id');
            $.ajax({
                url : 'admin/news/' + id + '/edit',
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    $('#title').val(result.title);
                    $('#description').val(result.description);
                    CKEDITOR.instances.content.setData(result.content);
                    $('#status').val(result.status);
                    $('#featured').val(result.featured);
                    $('#old_news_image').html('<img src="assets/uploads/news/image/' + result.image + '" alt="" style="width: 100px;" class="img-thumbnail">');
                    
                    sliders = result[1];
                    html = '';
                    $.each(sliders, function(key, value){
                        html += '<img src="assets/uploads/products/sliders/' + value.image + '" alt="" style="width: 100px;" class="img-thumbnail">';
                    });
                    $('#old_product_slider').html(html);
                }
            });
            $('#edit_news_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/news/update/' + id,
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

        $(document).on('click', '.delete_news_btn', function(){
            id = $(this).data('id');
            console.log(id);
            $(document).on('click', '.delete-yes', function(){
                $.ajax({
                    url : 'admin/news/' + id,
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
