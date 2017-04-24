<div id="uploader" class="uploader">
	<div class="uploader-topbar">
		<ul class="uploader-buttons">
			<!-- <li class="upload" style="float: left;">
				<i class="fa fa-upload"></i> Lưu hình ảnh
			</li> -->
			<li class="add-file">Thêm ảnh sản phẩm</li>
			<!-- <li class="notify-selected">Đã chọn 0 hình ảnh</li> -->
		</ul>
	</div>
	<div id="dropzone" class="dropzone">

		<div id="uploads" class="uploads">
			<ul id="list-file" class="list-file">
				@if(isset($product))
				@foreach($product->images as $image)
				<li class="item-preview" draggable="true">
					<div class="file-preview">
						<i class="fa fa-close remove-image" bind-remove-image="{{ $image->id }}"></i>
						<img src="{{ asset($image->url) }}" />
					</div>
				</li>
				@endforeach
				@endif
			</ul>
		</div>
		@if(isset($product) && count($product->images) != 0)
		<div class="no-file text-center" style="display: none;">
		@else
		<div class="no-file text-center">
		@endif
			<i class="fa fa-picture-o"></i> <br/>
			<span>Kéo thả hình ảnh vào đây để đăng hình ảnh cho sản phẩm</span>
		</div>
	</div>
</div>
<input id="file" type="file" style="visibility:hidden;" multiple="true" />