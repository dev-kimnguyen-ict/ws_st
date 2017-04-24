@extends('layouts.admin')

@section('navbar.active.account') active @endsection

@section('content')

@if(Session::has('message'))
<div class="widget">
	<div class="alert alert-{{ Session::get('message')['status'] }}">
		{{ Session::get('message')['message'] }}
	</div>
</div>
@endif

<div class="widget">
	{{ $account->email }}
</div>
@endsection
