<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

<div class="formRow">
	{!! Form::label('ten_san_pham', 'Tên sản phẩm:') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('ten_san_pham', isset($product->name) ? $product->name : null, ['required' => 'true', 'placeholder' => 'Nhập tên sản phẩm']) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('ten_san_pham'))
				<strong>{{ $errors->first('ten_san_pham') }}</strong>
				@endif
			</div>
		</div>
		<div class="oneTwo">
			<select name="danh_muc" style="margin: auto 45px;" class="select-category textC">
				<option value="0" selected="true" style="font-weight: bold;">--- Chọn danh mục sản phẩm ---</option>
				@if(isset($product->categoryid))
					{{ getCategory($categories, $product->categoryid) }}
				@else
					{{ getCategory($categories) }}
				@endif
			</select>
			<div class="clear error" name="name_error">
				@if ($errors->has('danh_muc'))
				<strong>{{ $errors->first('danh_muc') }}</strong>
				@endif
			</div>
			<a href="{{ route('admin.category.create') }}" style="position: absolute; right: 15px; top: 36%;">Tạo danh mục</a>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('hinh_hien_thi', 'Chọn hình hiển thị') !!}
	<div class="formRight">
		{!! Form::file('hinh_hien_thi', [
				'class' => 'fullwd',
				'title' => 'Chọn hình ảnh hiển thị của sản phẩm'
			])
		 !!}
		<div class="clear error" name="name_error">
			@if ($errors->has('hinh_hien_thi'))
			<strong>{{ $errors->first('hinh_hien_thi') }}</strong>
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('hinh_anh[]', 'Chọn hình ảnh kèm theo:') !!}
	<div class="formRight">
		{!! Form::file('hinh_anh[]', ['multiple' => 'true', 'class' => 'fullwd', 'title' => 'Chọn danh sách hình ảnh cho sản phẩm']) !!}
		<div class="clear error" name="name_error">
			@if ($errors->has('hinh_anh'))
			<strong>{{ $errors->first('hinh_anh') }}</strong>
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('gia_nhap', 'Giá nhập:') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('gia_nhap', isset($product->imprice) ? $product->imprice : null, ['required' => true, 'placeholder' => 'Điền giá nhập vào của sản phẩm']) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('gia_nhap'))
				<strong>{{ $errors->first('gia_nhap') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('gia_ban', 'Giá bán:') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('gia_ban', isset($product->price) ? $product->price : null, ['required' => true, 'placeholder' => 'Nhập giá bán cho sản phẩm']) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('gia_ban'))
				<strong>{{ $errors->first('gia_ban') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('giam_gia', 'Giảm giá:') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('giam_gia', isset($product->sale) ? $product->sale : null, ['placeholder' => 'Nhập phần trăm giảm giá']) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('giam_gia'))
				<strong>{{ $errors->first('giam_gia') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('trang_thai', 'Trạng thái:') !!}
	<div class="formRight">
		<div class="oneTwo">
			<div class="radiobox">
				<input id="hien_thi" type="radio" name="trang_thai" 
				@if((isset($product) && $product->status == true) || !isset($product->status))
					checked="true"
				 @endif
				 	value="1" />
				{!! Form::label('hien_thi', 'Hiển thị') !!}
			</div>
			<div class="radiobox">
				<input id="an" type="radio" name="trang_thai"
				@if(isset($product) && $product->status == false)
					checked="true"
				 @endif
					value="0"/>
				{!! Form::label('an', 'Ẩn') !!}
			</div>
			<div class="clear error" name="name_error">
				@if ($errors->has('trang_thai'))
				<strong>{{ $errors->first('trang_thai') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('bai_viet', 'Nội dung bài viết:') !!}
	<div class="formRight">
		<div class="">
			{!! Form::textarea('bai_viet', isset($product->longdesc) ? $product->longdesc : null) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('bai_viet'))
				<strong>{{ $errors->first('bai_viet') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
@if(!isset($product) || $product->shortdesc == null)
<div class="formRow">
	<div class="formRight">
		<a id="adddesc" href="javascript:void(0)">Thêm mô tả ngắn</a>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow" id="container_mo_ta" style="display: none;">
@else
<div class="formRow" id="container_mo_ta">
@endif
	{!! Form::label('mo_ta', 'Mô tả ngắn:') !!}
	<div class="formRight">
		<div class="">
			{!! Form::textarea('mo_ta', isset($product) && $product->shortdesc != null ? $product->shortdesc : null) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('mo_ta'))
				<strong>{{ $errors->first('mo_ta') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	<label for="seo_tieu_de" style="font-weight: bold; font-size: 16px;" class="textC">Tối ưu SEO</label>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('seo_tieu_de', 'Thẻ tiêu đề:') !!}
	<div class="formRight">
		<div class="oneTwo">
			<div class="input-helper">
				{!! Form::text('seo_tieu_de', null, ['required' => true, 'size' => '70']) !!}
				<div class="input-length" id="seo_tieu_de_length">0/70</div>
			</div>
			<div class="clear error" name="name_error">
				@if ($errors->has('seo_tieu_de'))
				<strong>{{ $errors->first('seo_tieu_de') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('seo_mo_ta', 'Thẻ mô tả:') !!}
	<div class="formRight">
		<div class="oneTwo">
			<div class="input-helper">
				{!! Form::text('seo_mo_ta', null, ['max' => 160]) !!}
				<div class="input-length" id="seo_mo_ta_length">0/160</div>
			</div>
			<div class="clear error" name="name_error">
				@if ($errors->has('seo_mo_ta'))
				<strong>{{ $errors->first('seo_mo_ta') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('seo_alias', 'Đường dẫn / Bí danh (Alias):') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('seo_alias', null, ['required' => true]) !!}
			<div class="clear error" name="name_error">
				@if ($errors->has('seo_alias'))
				<strong>{{ $errors->first('seo_alias') }}</strong>
				@endif
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<script>
	var tieuDeSize 	  = 70,
		moTaSize 	  = 160,
		subfix_tieude = '/' + tieuDeSize,
		subfix_mota	  = '/' + moTaSize,
		txtTenSP 	  = $('#ten_san_pham'),
		seoMoTa 	  = $('#seo_mo_ta'),
		seoMoTaLength = $('#seo_mo_ta_length'),
		seoTieuDe 	  = $('#seo_tieu_de'),
		seoTieuDeLength = $('#seo_tieu_de_length'),
		seoAlias 	  = $('#seo_alias');
	CKEDITOR.replace('mo_ta');
	CKEDITOR.replace('bai_viet');
	
	$('#adddesc').click(function(){
		$(this).parent('div').parent('div').remove();
		$('#container_mo_ta').show();
	});

	$(function(){
		// processSeoTieuDe(txtTenSP.val());
		seoMoTaLength.html(seoMoTa.val().length + subfix_mota);
		// seoAlias.val(changeToSlug(txtTenSP.val()));
	});

	function processTenSPChange(value) {
		processSeoTieuDe(value, true);
		seoAlias.val(changeToSlug(value));
	}
	function processSeoTieuDe(value, exception){
		if(value.length > tieuDeSize){
			seoTieuDeLength.html(tieuDeSize + subfix_tieude);
			seoTieuDe.val(value.slice(0, tieuDeSize));
		} else {
			if(exception) seoTieuDe.val(value);
			seoTieuDeLength.html(value.length + subfix_tieude);
		}
	}

	function processSeoMoTa(value){
		if(value.length > moTaSize){
			seoMoTaLength.html(moTaSize + subfix_mota);
			seoMoTa.val(value.slice(0, moTaSize));
		} else{
			seoMoTaLength.html(value.length + subfix_mota);
		}
	}

	txtTenSP.keyup(function(e){processTenSPChange(e.target.value);});
	txtTenSP.change(function(e){processTenSPChange(e.target.value);});
	seoTieuDe.keyup(function(e){processSeoTieuDe(e.target.value, false);});
	seoTieuDe.change(function(e){processSeoTieuDe(e.target.value, false);});
	seoMoTa.keyup(function(e){processSeoMoTa(e.target.value);});
	seoMoTa.change(function(e){processSeoMoTa(e.target.value);});
</script>