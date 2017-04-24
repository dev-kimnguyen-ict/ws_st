<script>	
	$(function(){
		var btnAddCart 	= $('.btn-insert-cart'),
			btnRemove 	= $(".remove-item-action"),
			btnDestroy 	= $('.btn-delete-cart'),
			notify		= $('.user-notification'),
			number 		= $('.product-number');
			// timeout 	= null;

		btnAddCart.bind('click', function(){
			// clearTimeout(timeout);
			var id = $(this).attr('id-bind-insert-cart'),
				formData = new FormData(),
				tempData = $(this).parent('form').serializeArray();
			if(id == null){
				return false;
			}
			formData.append('id', id);
			for (var i in tempData) {
				formData.append(tempData[i].name, tempData[i].value);
			}
			
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '{{ route("app.cart.insert", SUBFIX) }}');
			xhr.onreadystatechange = function(){
				notify.html();
				if(xhr.readyState == 4 && xhr.status == 403){
					notify.html('Quản trị viên + Nhân viên không được sử dụng tính năng này!');
					notify.slideDown(300);
					setTimeout(function(){
						notify.slideUp(500);
					}, 3000);
				}
				if(xhr.readyState == 4 && xhr.status == 422){
					var jsonObject 	= JSON.parse(xhr.responseText),
					errors 		= jsonObject.id,
					html 		= '',
					k;
					for(k in errors){
						html += '<br/>' + errors[k];
					}
					notify.html(html);
					notify.slideDown(300);
					setTimeout(function(){
						notify.slideUp(500);
					}, 3000);
				}
				if(xhr.readyState == 4 && xhr.status == 200){
					data = JSON.parse(xhr.responseText);
					notify.html(data.message);
					number.html(data.length);
					if(notify.css('display') == 'none'){
						notify.slideDown(300);
						setTimeout(function(){notify.slideUp();}, 3000);
					}
				}
			};
			xhr.send(formData);
		});
	
		btnRemove.bind('click', function(e) {
			e.preventDefault();
			var sl = confirm("Bạn chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng không?");
			if (sl) {
				var id = $(this).attr("id-bind-item"),
					formData = new FormData(),
					form 	 = $(this),
					data 	 = $(this).parent('form').serializeArray();
				formData.append('id', id);
				for(k in data){
					formData.append(data[k].name, data[k].value);
				}
				var xhr = new XMLHttpRequest();
				xhr.open('POST', '{{ route("app.cart.remove", SUBFIX) }}');
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						data = JSON.parse(xhr.responseText);
						number.html(data.length);
						$('#sum-price').html(data.amount);
						if(data.length == 0){
							$('.content-group-body').html(
								'<h4 style="margin: 20px; text-align: center;">' 
								+ 'Giỏ hàng của bạn hiện chưa có sản phẩm nào!</h4>'
								+ '<p style="text-align: center;">Mời bạn thăm quan cửa hàng và mua sắm!</p>'
							);
						}
						form.parent('form').parent('td').parent('tr').remove();
					}
				};
				xhr.send(formData);
			}
		});

		btnDestroy.bind('click', function(e) {
			e.preventDefault();
			var sl = confirm("Bạn chắc chắn muốn hủy giỏ hàng không?");
			if (sl) {
				var data 		= $(this).parent('form').serializeArray(),
					formData 	= new FormData();
				for(k in data){
					formData.append(data[k].name, data[k].value);
				}
				var xhr = new XMLHttpRequest();
				xhr.open('POST', '{{ route("app.cart.destroy", SUBFIX) }}');
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						number.html(0);
						$('.content-group-body').html(
							'<h4 style="margin: 20px; text-align: center;">' 
							+ 'Giỏ hàng của bạn hiện chưa có sản phẩm nào!</h4>'
							+ '<p style="text-align: center;">Mời bạn thăm quan cửa hàng và mua sắm!</p>'
						);
					}
				};
				xhr.send(formData);
			}
			return false;
		});

        // Khai báo đối tượng timeout để dùng cho hàm
        // clearTimeout
        var timeout = null;

        // Sự kiện keyup
        $('.input-quatity').on('change', function(e){
        	var input = $(this);
			// Xóa đi những gì ta đã thiết lập ở sự kiện
			// keyup của ký tự trước (nếu có)
			// clearTimeout(timeout);

			// Sau khi xóa thì thiết lập lại timeout
			// timeout = setTimeout(function ()
			// {
				// Lấy số lượng mới của sản phẩm
				var id = input.attr("id-bind-quatity"),
					q  = input.val(),
					xhr 	 = new XMLHttpRequest(),
					formData = new FormData(),
					data 	 = null;
				data = $('.input-quatity').parent('form').serializeArray();
				formData.append('id', id);
				for(k in data){
					formData.append(data[k].name, data[k].value);
				}
				xhr.open('POST', '{{ route("app.cart.update") }}');
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4){
						result = JSON.parse(xhr.responseText);
						if(xhr.status == 200){
							number.html(result.length);
							$('.product-number').html(result.quatity);
							$("#price-" + id).html(result.price);
							$("#sum-price").html(result.sum);
						}
					}
				};
				xhr.send(formData);
			// }//, 2000);
		});

		$('#dat-hang').on('click', function(){
			$('#form-dat-hang').fadeIn(300);
		});
	});
</script>