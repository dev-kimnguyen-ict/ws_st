<script>
	$(function(){
		var dropzone = document.getElementById('dropzone');
		var listPreview = $('#list-file');
		var baseUrl = '{{ url("/") }}';

		$('.add-file').click(function(){
			$('#file').click();
		});

		$('#file').bind('change', function(e){
			showPreview(e.target.files);
		});

		function showPreview(data) {
			NProgress.start();
			$('.no-file').hide();
			for (var i = 0; i < data.length; i++) {
				upload(data[i]);
			}
			NProgress.done();
		}

		function removeImage(id){
			var xhr = new XMLHttpRequest();
			var formData = new FormData();
			formData.append('_token', '{{ csrf_token() }}');
			formData.append('_method', 'DELETE');
			formData.append('id', id);
			if(xhr.readyState == 4 && this.status == 200){
				var data = JSON.parse(this.responseText);
				if(data.total == 0){
					noImage();
				}
			}
			xhr.open('POST', '{{ route("admin.product.removeImage", $product->id) }}');
			xhr.send(formData);
		}

		function noImage() {
			$('.no-file').show();
		}

		var upload = function (image){
			var xhr = new XMLHttpRequest();
			var notify = $('.notify');
			var message = notify.find('.notify-message');
			var formData = new FormData();

			formData.append('_token', '{{ csrf_token() }}');
			formData.append('_method', 'PUT');

			formData.append('hinh_anh', image);

			xhr.onreadystatechange = function() {
				if (this.readyState == 4) {
					var data = JSON.parse(this.responseText);

					// Validation error:
					if(this.status == 422){
						message.html('');
						notify.removeClass('notify-success');
						notify.addClass('notify-error');
						message.append(data.error);
						notify.slideToggle();
						setTimeout(function(){
							notify.slideToggle();
						}, 3000);
					}

					// Success:
					if(this.status == 200){
						var data = JSON.parse(this.responseText);
						var template = '<li class="item-preview">' +
											'<div class="file-preview"><i class="fa fa-close remove-image" bind-remove-image="' + data.image.id + '"></i>' +
											'<img src="/" ' + baseUrl + '/' + data.image.url + '></div>' +
											'</li>';
						listPreview.append(template);
					}
				}
			};

			xhr.open('POST', '{{ route("admin.product.saveImage", $product->id) }}');
			xhr.send(formData);
		}

		dropzone.ondrop = function(e){
			e.preventDefault();
			this.className = 'dropzone';
			showPreview(e.dataTransfer.files);
		};

		dropzone.ondragover = function(){
			this.className = 'dropzone dragover';
			return false;
		};

		dropzone.ondragleave = function(){
			this.className = 'dropzone';
		};

		function resetForm() {
			$('#product-reset').click();
			localFiles = new Array();
			listPreview.html('');
			$('.error').html('');
			$('.no-file').show();
		}

		listPreview.on('click', '.remove-image', function(){
			NProgress.start();
			removeImage($(this).attr('bind-remove-image'));
			$(this).parent('div').parent('li').remove();
			NProgress.done();
		});
});
</script>
