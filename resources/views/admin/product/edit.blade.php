@extends('layouts.admin')

@section('navbar.active.product') active @endsection

@section('content.menuaction')
@include('admin.product.menu_action')
@endsection

@section('content')
{!! Form::model($product, [
	'route' => ['admin.product.update', $product->id],
	'method' => 'PUT',
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
				{!! Form::submit('Lưu chỉnh sửa', ['class' => 'redB', 'id' => 'product-submit']) !!}
				{!! Form::reset('Nhập lại', ['class' => 'basic']) !!}
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
{!! Form::close() !!}
@include('admin.product._script_edit_product')
@endsection