@extends('layouts.admin')

<!-- Navigation active -->
@section('navbar.active.account') active @endsection

@section('content.menuaction')
@include('admin.account.menu_action');
@endsection

<!-- Content -->
@section('content')
@if(Session::has(MESSAGE) || $accounts->total() == 0)
<div class="widget">
	<div class="alert
	@if($accounts->total() == 0)
		alert-warning
	@else
		alert-{{ Session::get(MESSAGE)['status'] }}
	@endif">

	{{ Session::get(MESSAGE)['message'] }}

	@if($accounts->total() == 0)
	Không tìm thấy tài khoản nào
	@endif
</div>
</div>
@endif

<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input id="titleCheck" name="titleCheck" type="checkbox">
		</span>
		<h6>Danh sách tài khoản</h6>
		<div class="num f12">Số lượng: <b>{{ $accounts->total() }}</b></div>
	</div>

	<!-- Table -->
	<table id="checkAll" class="sTable mTable myTable" cellspacing="0" cellpadding="0" width="100%">
		<!-- Table filter -->
		<thead class="filter">
			<tr>
				<td colspan="11">
					@include('admin.account.filter')
				</td>
			</tr>
		</thead>
		<!-- End table filter -->

		<!-- Table head -->
		<thead>
			<tr>
				<td style="width:21px;">
					<img src="{{ URL::asset('contents/images/icons/tableArrows.png') }}">
				</td>
				<td style="width:50px;">Mã số</td>
				<td>Tên</td>
				<td>Email</td>
				<td>Điện thoại</td>
				<td>Địa chỉ</td>
				<td class="textC">Kích_hoạt</td>
				<td style="width: 50px;">Bị khóa</td>
				<td style="width: 30px;">Tài_khoản</td>
				<td class="textC" style="width: 120px;">Ngày tạo</td>
				<td style="width: 69px;">Hành động</td>
			</tr>
		</thead>
		<!-- End table head -->

		<!-- Table footer -->
		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="11" id="pagination">
					{{ $accounts->render() }}
				</td>
			</tr>
			<tr>
				<td colspan="0">
					<div class="list_action itemActions">
						<a url="#" class="button blueB" id="submit" href="#submit">
							<span style="color:white;">Xóa hết</span>
						</a>
					</div>
				</td>
			</tr>
		</tfoot>
		<!-- Table footer -->

		<tbody class="list_item" id="table-body">
			@foreach($accounts as $account)
			<!-- A row of table -->
			<tr class="row_9">
				<td><input type="checkbox" value="{{ $account->id }}" name="id[]"></td>
				<td class="textC">{{ $account->id }}</td>
				<td>{{ $account->name }}</td>
				<td class="">{{ $account->email }}</td>
				<td class="textC">{{ $account->phone }}</td>
				<td>{{ $account->address }}</td>
				<td class="textC">
					@if($account->actived)
					<span class="mark mark-blue center-block"/>
					@else
						-
					@endif
				</td>
				<td class="textC">
					@if($account->blocked)
					<span class="mark mark-red center-block"/>
					@else
						-
					@endif
				</td>
				<td class="textC">
					@if($account->groupid == 1)
					QTV
					@elseif($account->groupid == 2)
					NV
					@else
					TV
					@endif
				</td>
				<td>{{ $account->created_at }}</td>
				<td class="option textC">
					<a title="Xem chi tiết tài khoản" class="tipS" href="{{ route('admin.account.show', $account->id) }}">
						<img src="{{ URL::asset('contents/images/icons/color/view.png') }}">
					</a>
					<a class="tipS" title="Chỉnh sửa" href="{{ route('admin.account.edit', $account->id) }}">
						<img src="{{ URL::asset('contents/images/icons/color/edit.png') }}">
					</a>
					<a href="javascript:void(0)">
						{!! Form::open([
						'route' => ['admin.account.destroy', $account->id],
						'method' => 'DELETE'
						]) !!}
						{!! Form::submit('', ['class' => 'tipS btn-delete', 'title' => 'Xóa']) !!}
						{!! Form::close() !!}
					</a>
				</td>
			</tr>
			<!-- End a row of table -->
			@endforeach
		</tbody>
	</table>
	<!-- End table -->
</div>
@endsection
