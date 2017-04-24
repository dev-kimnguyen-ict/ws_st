<script>
	$(function(){
		var dropzone = document.getElementById('dropzone');
		var listPreview = $('#list-file');
		var localFiles = new Array();

		$('.add-file').click(function(){
			$('#file').click();
		});

		$('#file').bind('change', function(e){
			showPreview(e.target.files);
		});

		listPreview.on('click', '.remove-image', function(){
			var li = $(this).parent('div').parent('li');
			removeImage(li.index());
			li.remove()
		});

		function removeImage(index){
			localFiles.splice(index, 1);
		}

		function showPreview(data) {
			$('.no-file').hide();
			if(localFiles == null)
				localFiles = new Array();
			for (var i = 0; i < data.length; i++) {
				var reader = new FileReader();
				reader.readAsDataURL(data[i]);
				localFiles.push(data[i]);

				reader.onload = function (e) {
					var template = '<li class="item-preview" draggable="true">' + 
					'<div class="file-preview"><i class="fa fa-close remove-image"></i>' + 
					'<img src="' + e.target.result + '" /></div>' +
					'</li>';
					listPreview.append(template);
				};
			}
		}

		var upload = function (formData){
			var xhr = new XMLHttpRequest();
			var notify = $('.notify');
			var message = notify.find('.notify-message');
			xhr.onreadystatechange = function() {
				if (this.readyState == 4) {
					var data = JSON.parse(this.responseText);

					// Validation error:
					if(this.status == 422){
						message.html('');
						notify.removeClass('notify-success');
						notify.addClass('notify-error');
						for(var property in data){
							if(data[property] != null){
								var html = '';
								for(var i in data[property]){
									html += '<strong>' + data[property][i] + '</strong> ';
								}
								$('input[name="' + property + '"] + div.error').html(html);
								message.append(' ' + html);
							}
						}
						notify.slideToggle();
						setTimeout(function(){
							notify.slideToggle();
						}, 3000);
					}

					// Success:
					if(this.status == 200){
						message.html(data.message);
						notify.removeClass('notify-error');
						notify.addClass('notify-success')
						notify.slideToggle();
						resetForm();
						setTimeout(function(){
							notify.slideToggle();
						}, 3000);
					}
				}
				NProgress.done();
			};

			xhr.open('post', '{{ route("admin.product.store") }}');
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

		// Submit
		$('#form').submit(function(e){
			e.preventDefault();
			NProgress.start();
			var formData = new FormData();
			var data = $(this).serializeArray();
			for (var i = 0; i < data.length; i++) {
				formData.append(data[i].name, data[i].value);
			}
			for (var i = 0; i < localFiles.length; i++) {
				formData.append('hinh_anh[' + i + ']', localFiles[i]);
			}
			upload(formData);
		});
});
</script>