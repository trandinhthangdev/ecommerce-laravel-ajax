@extends('admin.layouts.master')

@section('title')
    {{ $category->name }} - {{ $brand->name }} - Product
@endsection

@section('content')
    <div class="container mt-2">
        <div class="jumbotron bg-dark text-center">
            <span class="text-light h2">{{ $category->name }}</span>
            <input type="hidden" id="category_id" value="{{ $category->id }}">
            <span class="text-light h5">{{ $brand->name }}</span>
            <input type="hidden" id="brand_id" value="{{ $brand->id }}">
            <span class="text-light">Product</span>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12 text-right mb-3">
                <button class="btn btn-dark" data-toggle="modal" data-target="#add_product_modal" id="add_product_btn"><span><i class="fa fa-plus"></i></span></button>
            </div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th class="text-center">
                                <span><i class="fa fa-info-circle"></i></span>
                            </th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($product))
                        @foreach($product as $key => $value)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $value->name }}</td>
                            <td>
                                <button class="btn btn-dark btn-sm mb-2 info_product_btn" data-toggle="modal" data-target="#info_product_modal" data-id="{{ $value->id }}"><span><i class="fa fa-eye"></i></span></button>
                                <div class="dropdown-divider"></div>
                                <span class="font-weight-bolder">Quantity : </span>
                                <small class="font-italic">{{ $value->quantity }}</small>
                                <br>
                                <span class="font-weight-bolder">Price : </span>
                                <small class="font-italic">{{ $value->price }}</small>
                                <br>
                                @if($value->discount_price != null)
                                <span class="font-weight-bolder">Discount Price : </span>
                                <small class="font-italic">{{ $value->discount_price }}</small>
                                <br>
                                @endif
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
                                <button class="btn btn-dark btn-sm mb-2 view_product_btn" data-toggle="modal" data-target="#view_product_modal" data-id="{{ $value->id }}"><span><i class="fa fa-eye"></i></span></button>
                                <button class="btn btn-dark btn-sm mb-2 edit_product_btn" data-toggle="modal" data-target="#edit_product_modal" data-id="{{ $value->id }}"><span><i class="fa fa-edit"></i></span></button>
                                <button class="btn btn-dark btn-sm mb-2 delete_product_btn" data-toggle="modal" data-target="#delete_product_modal" data-id="{{ $value->id }}"><span><i class="fa fa-trash"></i></span></button>
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
                <div>{{ $product->links() }}</div>
            </div>
            <div class="col-12 text-center">
                <button class="btn btn-dark"><span><i class="fa fa-spinner"></i></span></button>
            </div>
        </div>  
    </div>

    <!-- Info Product Modal -->
    <div class="modal" id="info_product_modal">
        <div class="modal-dialog" style="min-width: 100%; margin: 0; min-height: 100vh;">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Info Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <span class="font-weight-bolder">Thumbnail</span>
                    <div id="info_product_thumbnail">
                        
                    </div>
                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Slider</span>
                    <div id="info_product_slider">
                        
                    </div>
                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Description</span><br>
                    <span class="font-italic" id="info_product_description">
                        
                    </span>
                    <div class="dropdown-divider"></div>
                    <span class="font-weight-bolder">Overview</span><br>
                    <div class="overflow-auto" id="info_product_overview" style="min-width:100%; min-height:75vh;">
                        
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- View Product Modal -->
    <div class="modal" id="view_product_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">View Product</h4>
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

    <!-- Add Product Modal -->
    <div class="modal" id="add_product_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="add_product_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                            <div id="name_error_add">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="overview">Overview</label>
                            <textarea class="form-control" rows="20" name="overview" id="overview_add" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" placeholder="Enter quantity" name="quantity" required>
                        </div> 
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" placeholder="Enter price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Discount Price</label>
                            <input type="number" class="form-control" placeholder="Enter discount price" name="discount_price">
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control-file" name="thumbnail" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label for="slider">Slider</label>
                            <input type="file" multiple class="form-control-file" name="sliders[]" accept="image/*" required>
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

    <!-- Edit Product Modal -->
    <div class="modal" id="edit_product_modal">
        <div class="modal-dialog">
            <div class="modal-content font-weight-bolder">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form id="edit_product_form">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                            <div id="name_error_edit">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="overview">Overview</label>
                            <textarea class="form-control" id="overview" name="overview" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" required>
                        </div> 
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Discount Price</label>
                            <input type="number" class="form-control" id="discount_price" placeholder="Enter discount price" name="discount_price">
                        </div>
                        <div class="form-group">
                            <label for="thumbnail">Thumbnail</label>
                            <input type="file" class="form-control-file" id="thumbnail" name="thumbnail">
                            <div id="old_product_thumbnail">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="slider">Slider</label>
                            <input type="file" multiple class="form-control-file" id="slider" name="sliders[]">
                            <div id="old_product_slider">
                                
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

    <!-- Delete Product Modal-->
    <div class="modal" id="delete_product_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Do you want to delete this product ?</h4>
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
        CKEDITOR.replace('overview_add');
        CKEDITOR.replace('overview');
</script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function(){
        $(document).on('click', '#add_product_btn', function(){
            $('#add_product_form').on('submit',function(event){
                category_id = $('#category_id').val();
                brand_id = $('#brand_id').val();
                event.preventDefault();
                $.ajax({
                    url : 'admin/' + category_id + '/' + brand_id + '/product',
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

        $(document).on('click', '.info_product_btn', function(){
            id = $(this).data('id');
            console.log(id);
            $.ajax({
                url : 'admin/product/' + id,
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    product = result[0];
                    $('#info_product_thumbnail').html('<img src="assets/uploads/products/thumbnail/' + product.thumbnail + '" alt="" style="width: 100px;" class="img-thumbnail">');
                    $('#info_product_description').html(product.description);
                    $('#info_product_overview').html(product.overview);

                    sliders = result[1];
                    html = '';
                    $.each(sliders, function(key, value){
                        html += '<img src="assets/uploads/products/sliders/' + value.image + '" alt="" style="width: 100px;" class="img-thumbnail">';
                    });
                    $('#info_product_slider').html(html);
                }
            });
        });

        $(document).on('click', '.edit_product_btn', function(){
            id = $(this).data('id');
            console.log()
            $.ajax({
                url : 'admin/product/' + id + '/edit',
                type : 'GET',
                dataType : 'JSON',
                success : function(result){
                    product = result[0];
                    $('#name').val(product.name);
                    $('#description').val(product.description);
                    CKEDITOR.instances.overview.setData(product.overview);
                    $('#quantity').val(product.quantity);
                    $('#price').val(product.price);
                    $('#discount_price').val(product.discount_price);
                    $('#status').val(product.status);
                    $('#featured').val(product.featured);
                    $('#old_product_thumbnail').html('<img src="assets/uploads/products/thumbnail/' + product.thumbnail + '" alt="" style="width: 100px;" class="img-thumbnail">');
                    
                    sliders = result[1];
                    html = '';
                    $.each(sliders, function(key, value){
                        html += '<img src="assets/uploads/products/sliders/' + value.image + '" alt="" style="width: 100px;" class="img-thumbnail">';
                    });
                    $('#old_product_slider').html(html);
                }
            });
            $('#edit_product_form').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url : 'admin/product/update/' + id,
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

        $(document).on('click', '.delete_product_btn', function(){
            id = $(this).data('id');
            console.log(id);
            $(document).on('click', '.delete-yes', function(){
                $.ajax({
                    url : 'admin/product/' + id,
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
