$(document).ready(function(){
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	// validate register form
	$("#registerForm").validate({
		rules: {
			email: {
				required: true,
				email: true,
				remote: "check-email"
			}
		},
		messages: {
			email: {
				required: "Please enter your email address",
				email: "Please enter a valid email address",
				remote: "Email already exists"
			}
		}
	});

	//Update cart items quantity
	$(document).on('click','.btnItemUpdate',function(){
		// if qtyMinus button has clicked by the user
		if($(this).hasClass('qtyMinus')){
			var quantity = $(this).prev().val();
			if(quantity<=1){
				alert('Quantity must equal or greater the 1');
				return false;
			}else{
				var new_qty = parseInt(quantity)-1;
			}
		}
		// if qtyPlus button has clicked by the user
		if($(this).hasClass('qtyPlus')){
			var quantity = $(this).prev().prev().val();
			var new_qty = parseInt(quantity)+1;
		}
		    
		   var cartid = $(this).data('cartid');
			$.ajax({
				url:'/update-cart-item-qty',
				data:{'qty':new_qty,'cartid':cartid},
				type:'post',
				success:function(data){
					if(data.status==false){
						alert('Product stock is not abvailable');
					}else{
						$('.totalCartItems').html('('+data.totalCartItems+')');
						$('#appendCartItems').html(data.view);
					}
					
				},error:function(){
					alert('Error');
				}
			});
	});

	//Delete cart item
	$(document).on('click','.btnItemDelete',function(){
		var cartid = $(this).data('cartid');
		if(confirm('Are you sure want to delete')){
			$.ajax({
			url:'/delete-cart-item',
			data:{'cartid':cartid},
			type:'post',
			success:function(data){
				$('.totalCartItems').html('('+data.totalCartItems+')');
			  $('#appendCartItems').html(data.view);
			},error:function(){
				alert('Error');
			}
		 });
		}
	});

});