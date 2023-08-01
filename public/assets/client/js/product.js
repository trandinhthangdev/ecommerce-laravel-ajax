$(document).ready(function(){
    $('.delete-product').click(function(){
        id = $(this).data('id');
        console.log(id);
        $('.delete-yes').click(function(){
        	$.ajax({
            	url : 'admin/product/delete/' + id,
            	type: 'GET',
            	dataType: 'text',
            	success: function(result){
            		toastr.success(result, 'Response', {timeOut: 5000});
            		$('#delete').modal('hide');
            		setTimeout(function() {
				        window.location.reload();
				    }, 500);
            	}
            });
        });
    });

    function show_data(result)
    {
    	let html = '';
		if(result.length > 0)
		{
			$.each(result, function(key, value){
				html += '<tr>';
					html += '<td>' + (key+1)  + '</td>';
					html += '<td>' + value.name + '</td>';
					html += '<td>' + value.slug + '</td>';
					html += '<td class="text-center">';
						if(value.status == 1)
						{
							html += ' <span class="badge badge-danger status-badge" data-id="'+ value.id +'">Show</span>';
						}
						else
						{
							html += ' <span class="badge badge-success status-badge" data-id="'+ value.id +'">Hide</span>';
						}
					html += '</td>';
					html += '<td class="text-center">';
						html += ' <a href="admin/category/edit/'+ value.id +'/'+ value.slug +'"><button class="badge badge-success"><span><i class="fa fa-edit"></i></span></button></a>';
						html += '<button class="badge badge-danger delete-category" data-id="' + value.id + '" data-toggle="modal" data-target="#delete"><span><i class="fa fa-trash"></i></span></button>';
					html += '</td>';
			});
		}
		else
		{
			html += '<tr>';
				html += '<td>Not Data</td>'
			html += '</tr>';
		}
		$('tbody').html(html);
    }

    function search(keyword)
    {
    	$.ajax({
    		url : 'admin/category/search',
    		type : 'POST',
    		dataType : 'json',
            data : {
                keyword : keyword
            },
    		success : function(result)
    		{
    			show_data(result);
    		}
    	});
    }

    $('#auto_search').keyup(function(){
    	keyword = $(this).val();
    	search(keyword);
    });

    $('#btn_search').click(function(){
    	keyword = $('#search').val();
    	search(keyword);
    });

    $('#filter_status').change(function(){
    	status = $(this).val();
    	$.ajax({
    		url : 'admin/category/filter_status',
    		type : 'POST',
    		dataType : 'json',
    		data : {
    			status : status
    		},
    		success : function(result)
    		{
    			show_data(result);
    		}
    	});
    });

    $('.sort_select').click(function(){
    	var sort = $(this).data('id');
    	var sort_column = '';
    	var sort_type = '';
    	switch(sort)
    	{
    		case 1 : 
        		$('#sort_a_z').append('<span id="check_a_z"><i class="fa fa-check"></i></span>');
                $('#check_z_a').remove();
                $('#check_show').remove();
                $('#check_hide').remove();
    			sort_column = 'name';
    			sort_type = 'ASC';
    			break;
    		case 2 : 
    			$('#sort_z_a').append('<span id="check_z_a"><i class="fa fa-check"></i></span>');
                $('#check_a_z').remove();
                $('#check_show').remove();
                $('#check_hide').remove();
    			sort_column = 'name';
    			sort_type = 'DESC';
    			break;
    		case 3 : 
    			$('#sort_show').append('<span id="check_show"><i class="fa fa-check"></i></span>');
                $('#check_z_a').remove();
                $('#check_a_z').remove();
                $('#check_hide').remove();
    			sort_column = 'status';
    			sort_type = 'DESC';
    			break;
    		case 4 : 
    			$('#sort_a_z').append('<span id="check_hide"><i class="fa fa-check"></i></span>');
                $('#check_z_a').remove();
                $('#check_show').remove();
                $('#check_a_z').remove();
    			sort_column = 'status';
    			sort_type = 'ASC';
    			break;
    	}

    	$.ajax({
    		url : 'admin/category/sort',
    		type : 'POST',
    		dataType : 'json',
    		data : {
    			sort_column : sort_column,
    			sort_type : sort_type
    		},
    		success : function(result)
    		{
    			show_data(result);
    		}
    	});
    });

    $(document).on('click','.status-badge',function(){
    	var id = $(this).data('id');
    	$.ajax({
    		url : 'admin/category/change_status/' + id,
    		type : 'GET',
    		dataType : 'json',
    		success : function(result)
    		{
    			show_data(result);
    		}
    	});
    });
});