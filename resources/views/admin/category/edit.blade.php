@extends('layouts.admin')

@section('navbar.active.category') active @endsection


@section('content.menuaction')
@include('admin.category.menu_action')
@endsection

@section('content')
{!! Form::model($category, [
	'route' => ['admin.category.update', $category->id],
	'method' => 'PUT',
	'class' => 'form',
	'id' => 'form'
]) !!}
	<fieldset>
		<div class="widget">
			<div class="title">
				<img class="titleIcon" src="{{ asset('contents/images/icons/dark/add.png') }}"/>
				<h6>{{ $title }}</h6>
			</div>

			<div class="tab_container">
				<div class="tab_content pd0" id="tab1">
					@include('admin.category._form_category')
					<div class="formRow hide"></div>
				</div>

			</div><!-- End tab_container-->

			<div class="formSubmit">
				{!! Form::submit('Lưu thay đổi', ['class' => 'redB']) !!}
				{!! Form::reset('Nhập lại', ['class' => 'basic']) !!}
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
{!! Form::close() !!}
@endsection