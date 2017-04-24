@extends('layouts.admin')

@section('navbar.active.product') active @endsection

@section('content.menuaction')
@include('admin.product.menu_action')
@endsection

@section('content')
{!! Form::open([
	'route' => 'admin.product.store',
	'method' => 'POST',
	'class' => 'form',
	'id' => 'form',
	'enctype' => 'mulpart/form-data',
	'files' => 'true'
]) !!}
	<fieldset>
		<div class="widget">
			<div class="title">
				<img class="titleIcon" src="{{ asset('contents/images/icons/dark/add.png') }}"/>
				<h6>{{ $title }}</h6>
			</div>

			<div class="tab_container">
				<div class="tab_content pd0" id="tab1">
				
					@include('admin.product._form_product')

					<div class="formRow hide"></div>
				</div>
			</div><!-- End tab_container-->

			<div class="formSubmit">
				{!! Form::submit('Thêm sản phẩm', ['class' => 'redB', 'id' => 'product-submit']) !!}
				{!! Form::reset('Nhập lại', ['class' => 'basic', 'id' => 'product-reset']) !!}
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
{!! Form::close() !!}
@include('admin.product._script_upload_image')
@endsection