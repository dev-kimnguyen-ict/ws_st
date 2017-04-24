@extends('layouts.admin')

@section('navbar.active.account') active @endsection

@section('content.menuaction')
@include('admin.account.menu_action')
@endsection

@section('content')
{!! Form::model($account, [
	'route' => ['admin.account.update', $account->id],
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
					
					<img style="width: 200px; height: 200px;" src="{{ asset($account->avatar) }}" alt="{{ $account->name }}"/>

					@include('admin.account._form_account')
					
					<div class="formRow hide"></div>
				</div>

			</div><!-- End tab_container-->

			<div class="formSubmit">
				{!! Form::submit('Cập nhật thông tin mới', ['class' => 'redB']) !!}
				{!! Form::reset('Nhập lại', ['class' => 'basic']) !!}
			</div>
			<div class="clear"></div>
		</div>
	</fieldset>
</form>
@endsection