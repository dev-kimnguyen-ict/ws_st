@extends('layouts.admin')

@section('navbar.active.product') active @endsection

@section('content.menuaction')
@include('admin.product.menu_action')
@endsection

@section('content')
@if(Session::has(MESSAGE) || $products->total() == 0)
<div class="widget">
	<div class="alert 
		@if($products->total() == 0)
			alert-warning
		@else
			alert-{{ Session::get(MESSAGE)['status'] }}
		@endif">

		{{ Session::get(MESSAGE)['message'] }}

		@if($products->total() == 0)
			Không tìm thấy sản phẩm nào
		@endif
	</div>
</div>
@endif

<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input id="titleCheck" name="titleCheck" type="checkbox">
		</span>
		<h6>Danh sách sản phẩm</h6>
		<div class="num f12">Số lượng: <b>{{ $products->total() }}</b></div>
	</div>

	<!-- Table -->
	<table id="checkAll" class="sTable mTable myTable" cellspacing="0" cellpadding="0" width="100%">
		<!-- Table filter -->
		<thead class="filter">
			<tr>
				<td colspan="11">
					@include('admin.product.filter')
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
				<td>Hình ảnh</td>
				<td style="width: 180px;">Tên sản phẩm</td>
				<td>Giá nhập</td>
				<td>Giá bán</td>
				<td>Lượt xem</td>
				<td style="width: 120px;">Danh mục cha</td>
				<td style="width: 155px; overflow-wrap: hidden;">Mô tả ngắn</td>
				<td style="width: 120px;">Ngày tạo</td>
				<td style="width: 69px;">Hành động</td>
			</tr>
		</thead>
		<!-- End table head -->

		<!-- Table footer -->
		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="11" id="pagination">
					{{ $products->render() }}
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
			@foreach($products as $product)
			<!-- A row of table -->
			<tr class="row_9">
				<td><input type="checkbox" value="{{ $product->id }}" name="id[]"></td>
				<td class="textC">{{ $product->id }}</td>
				<td>
					@if($product->thumb)
						<img src="{{ asset($product->thumb) }}" style="width: 50px; height: 50px;" />
					@endif
				</td>
				<td class="textC">{{ $product->name }}</td>
				<td class="price">{{ number_format($product->imprice, null, null, '.') }}</td>
				<td class="price">{{ number_format($product->price, null, null, '.') }}</td>
				<td class="textC">{{ $product->viewed }}</td>
				<td class="textC">{{ $product->category['name'] }}</td>
				<td class="textC">{!! $product->shortdesc !!}</td>
				<td class="textC">{{ $product->updated_at }}</td>
				<td class="option textC">
					<a class="tipS" title="Chỉnh sửa" href="{{ route('admin.product.edit', $product->id) }}">
						<img src="{{ URL::asset('contents/images/icons/color/edit.png') }}">
					</a>
					<a href="javascript:void(0)">
						{!! Form::open([
						'route' => ['admin.product.destroy', $product->id],
						'method' => 'DELETE'
						]) !!}
						{!! Form::submit('', ['class' => 'tipS btn-delete', 'title' => 'Xóa sản phẩm']) !!}
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