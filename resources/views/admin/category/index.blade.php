@extends('layouts.admin')

@section('navbar.active.category') active @endsection

@section('content.menuaction')
@include('admin.category.menu_action')
@endsection

@section('content')
@if(Session::has(MESSAGE) || $categories->total() == 0)
<div class="widget">
	<div class="alert
		@if($categories->total() == 0)
			alert-warning
		@else
			alert-{{ Session::get(MESSAGE)['status'] }}
		@endif">

		{{ Session::get(MESSAGE)['message'] }}

		@if($categories->total() == 0)
			Không tìm thấy danh mục nào
		@endif
	</div>
</div>
@endif

<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input id="titleCheck" name="titleCheck" type="checkbox">
		</span>
		<h6>Danh sách danh mục</h6>
		<div class="num f12">Số lượng: <b>{{ $categories->total() }}</b></div>
	</div>

	<!-- Table -->
	<table id="checkAll" class="sTable mTable myTable" cellspacing="0" cellpadding="0" width="100%">
		<!-- Table filter -->
		<thead class="filter">
			<tr>
				<td colspan="11">
					@include('admin.category.filter')
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
				<td style="width:50px;">STT</td>
				<td style="width: 180px;">Tên danh mục</td>
				<td style="width: 120px;">Danh mục cha</td>
				<td style="width: 155px;">Mô tả</td>
				<td style="width: 120px;">Ngày tạo</td>
				<td style="width: 69px;">Hành động</td>
			</tr>
		</thead>
		<!-- End table head -->

		<!-- Table footer -->
		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="11" id="pagination">
					{{ $categories->render() }}
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
			@foreach($categories as $position => $category)
			<!-- A row of table -->
			<tr class="row_9">
				<td><input type="checkbox" value="{{ $category->id }}" name="id[]"></td>
				<td class="textC">{{ ++$position }}</td>
				<td class="textC">{{ $category->name }}</td>
				<td class="textC">{{ $category->category['name'] }}</td>
				<td>{!! $category->desc !!}</td>
				<td class="textC">{{ $category->updated_at }}</td>
				<td class="option textC">
					<a class="tipS" title="Chỉnh sửa" href="{{ route('admin.category.edit', $category->id) }}">
						<img src="{{ URL::asset('contents/images/icons/color/edit.png') }}">
					</a>
					<a href="javascript:void(0)">
						{!! Form::open([
						'route' => ['admin.category.destroy', $category->id],
						'method' => 'DELETE'
						]) !!}
						{!! Form::submit('', ['class' => 'tipS btn-delete', 'title' => 'Xóa danh mục']) !!}
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
