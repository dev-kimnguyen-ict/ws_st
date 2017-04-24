<script src="//cdn.ckeditor.com/4.5.8/standard/ckeditor.js"></script>

<div class="formRow">
	{!! Form::label('ten_danh_muc', 'Tên danh mục (*):', ['class' => 'formLeft']) !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('ten_danh_muc', isset($category->name) ? $category->name : null, ['_autocheck' => 'true', 'required' => 'true']) !!}
			<span class="autocheck" name="name_autocheck"></span>
			<div class="clear error" name="name_error">
				@if ($errors->has('ten_danh_muc'))
				{{ $errors->first('ten_danh_muc') }}
				@endif
			</div>
		</div>
		<div class="oneTwo">
			<select name="danh_muc_cha" class="select-category textC" style="margin-left: 100px;">
				<option value="0" style="font-weight: bold;">--- Chọn danh mục cha ---</option>
				{{ getCategory($categories, isset($category->parentid) ? $category->parentid : null) }}
			</select>
			<span class="autocheck" name="name_autocheck"  style="margin-left: 90px;"></span>
			<div class="clear error" name="name_error"  style="margin-left: 90px;">
				@if ($errors->has('danh_muc_cha'))
				{{ $errors->first('danh_muc_cha') }}
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
				@if((isset($category) && $category->status == true) || !isset($category->status))
					checked="true"
				 @endif
				 	value="1" />
				{!! Form::label('hien_thi', 'Hiển thị') !!}
			</div>
			<div class="radiobox">
				<input id="an" type="radio" name="trang_thai"
				@if(isset($category) && $category->status == false)
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
	<div class="formRight">
		<a id="adddesc" href="javascript:void(0)">Thêm mô tả danh mục</a>
	</div>
	<div class="clear"></div>
</div>

<div class="formRow" style="display: none;" id="container_mo_ta">
	{!! Form::label('mo_ta', 'Mô tả:', ['class' => 'formLeft']) !!}
	<div class="formRight">
		{!! Form::textarea('mo_ta', isset($category->desc) ? $category->desc : null, ['_autocheck' => 'true']) !!}
		<span class="autocheck" name="name_autocheck"></span>
		<div class="clear error" name="name_error">
			@if ($errors->has('mo_ta'))
			{{ $errors->first('mo_ta') }}
			@endif
		</div>
	</div>
	<div class="clear"></div>
</div>


<div class="formRow">
	<label for="seo_tieu_de" style="font-weight: bold; font-size: 16px;" class="textC">Tối ưu SEO</label>
	<div class="clear"></div>
</div>

<div class="formRow">
	{!! Form::label('seo_tieu_de', 'Thẻ tiêu đề (*):') !!}
	<div class="formRight">
		<div class="oneTwo">
			<div class="input-helper">
				{!! Form::text('seo_tieu_de', isset($category) ? $category->seo['title'] : null, ['required' => true, 'size' => '70']) !!}
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
				{!! Form::text('seo_mo_ta', isset($category) ? $category->seo['desc'] : null, ['max' => 160]) !!}
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
	{!! Form::label('seo_alias', 'Đường dẫn / Bí danh (*):') !!}
	<div class="formRight">
		<div class="oneTwo">
			{!! Form::text('seo_alias', isset($category) ? $category->seo['alias'] : null, ['required' => true]) !!}
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
		txtTenSP 	  = $('#ten_danh_muc'),
		seoMoTa 	  = $('#seo_mo_ta'),
		seoMoTaLength = $('#seo_mo_ta_length'),
		seoTieuDe 	  = $('#seo_tieu_de'),
		seoTieuDeLength = $('#seo_tieu_de_length'),
		seoAlias 	  = $('#seo_alias');
	CKEDITOR.replace('mo_ta');
	
	$('#adddesc').click(function(){
		$(this).parent('div').parent('div').remove();
		$('#container_mo_ta').show();
	});

	$(function(){
		// processSeoTieuDe(txtTenSP.val());
		seoTieuDeLength.html(seoTieuDe.val().length + subfix_tieude);
		seoMoTaLength.html(seoMoTa.val().length + subfix_mota);
		// seoAlias.val(changeToSlug(txtTenSP.val()));
	});

	txtTenSP.keyup(function(e) {processTieuDeChange(e.target.value);});
	txtTenSP.change(function(e) {processTieuDeChange(e.target.value);});
	seoTieuDe.keyup(function(e){processSeoTieuDe(e.target.value, false);});
	seoTieuDe.change(function(e){processSeoTieuDe(e.target.value, false);});
	seoMoTa.keyup(function(e){processSeoMoTa(e.target.value);});
	seoMoTa.change(function(e){processSeoMoTa(e.target.value);});

	function processSeoTieuDe(value, exception){
		if(value.length > tieuDeSize){
			seoTieuDeLength.html(tieuDeSize + subfix_tieude);
			seoTieuDe.val(value.slice(0, tieuDeSize));
		} else {
			if(exception) seoTieuDe.val(value);
			seoTieuDeLength.html(value.length + subfix_tieude);
		}
	}
	function processTieuDeChange(value){
		processSeoTieuDe(value, true);
		seoAlias.val(changeToSlug(value));
	}

	function processSeoMoTa(value){
		if(value.length > moTaSize){
			seoMoTaLength.html(moTaSize + subfix_mota);
			seoMoTa.val(value.slice(0, moTaSize));
		} else{
			console.log('fsdfasd');
			seoMoTaLength.html(value.length + subfix_mota);
		}
	}
</script>