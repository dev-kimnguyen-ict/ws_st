@extends('layouts.admin')

@section('head.title')
Quản lý sản phẩm
@endsection

@section('menuaction')
	@include('admin.struct.menuaction')
@endsection

@section('content')
<div class="widget">
	<div class="title">
		<span class="titleIcon">
			<input id="titleCheck" name="titleCheck" type="checkbox">
		</span>
		<h6>Danh sách sản phẩm</h6>
		<div class="num f12">Số lượng: <b>0</b></div>
	</div>

	<!-- Table -->
	<table id="checkAll" class="sTable mTable myTable" cellspacing="0" cellpadding="0" width="100%">
		<!-- Table filter -->
		<thead class="filter">
			<tr>
				<td colspan="6">
					<form class="list_filter form" action="index.php/admin/product.html" method="get">
						<table width="80%" cellpadding="0" cellspacing="0">
							<tbody>

								<tr>
									<td class="label" style="width:40px;">
										<label for="filter_id">Mã số</label>
									</td>
									<td class="item">
										<input name="id" value="" id="filter_id" style="width:55px;" type="text">
									</td>

									<td class="label" style="width:40px;">
										<label for="filter_id">Tên</label>
									</td>
									<td class="item" style="width:155px;">
										<input name="name" value="" id="filter_iname" style="width:155px;" type="text">
									</td>

									<td class="label" style="width:60px;">
										<label for="filter_status">Thể loại</label>
									</td>
									<td class="item">
										<select name="catalog">
											<option value=""></option>
											<!-- kiem tra danh muc co danh muc con hay khong -->
											<optgroup label="Tivi">
												<option value="18">Toshiba</option>
												<option value="17">Samsung</option>
												<option value="16">Panasonic</option>
												<option value="15">LG</option>
												<option value="14">JVC</option>
												<option value="13">AKAI</option>
											</optgroup>

											<!-- kiem tra danh muc co danh muc con hay khong -->
											<optgroup label="Điện thoại">
												<option value="12">HTC</option>
												<option value="11">BlackBerry</option>
												<option value="10">Asus</option>
												<option value="9">Apple</option>
											</optgroup>

											<!-- kiem tra danh muc co danh muc con hay khong -->
											<optgroup label="Laptop">
												<option value="8">HP</option>
												<option value="7">Dell</option>
												<option value="6">Asus</option>
												<option value="5">Apple</option>
												<option value="4">Acer</option>
											</optgroup>

										</select>
									</td>

									<td style="width:150px">
										<input class="button blueB" value="Lọc" type="submit">
										<input class="basic" value="Reset" onclick="window.location.href = 'index.php/admin/product.html'; " type="reset">
									</td>

								</tr>
							</tbody>
						</table>
					</form>
				</td>
			</tr>
		</thead>
		<!-- End table filter -->

		<!-- Table head -->
		<thead>
			<tr>
				<td style="width:21px;"><img src="{{ URL::asset('contents/images/icons/tableArrows.png') }}"></td>
				<td style="width:60px;">Mã số</td>
				<td>Tên</td>
				<td>Giá</td>
				<td style="width:75px;">Ngày tạo</td>
				<td style="width:120px;">Hành động</td>
			</tr>
		</thead>
		<!-- End table head -->

		<!-- Table footer -->
		<tfoot class="auto_check_pages">
			<tr>
				<td colspan="6">
					<div class="list_action itemActions">
						<a url="admin/product/del_all.html" class="button blueB" id="submit" href="#submit">
							<span style="color:white;">Xóa hết</span>
						</a>
					</div>
					<div class="pagination"></div>
				</td>
			</tr>
		</tfoot>
		<!-- Table footer -->

		<tbody class="list_item">

			<!-- A row of table -->
			<tr class="row_9">
				<td>
					<input type="checkbox" value="9" name="id[]">
				</td>
				<td class="textC">9</td>
				<td>
					<div class="image_thumb">
						<img height="50" src="#">
						<div class="clear"></div>
					</div>

					<a target="_blank" title="" class="tipS" href="product/view/9.html">
						<b>Tivi LG 520</b>
					</a>
					<div class="f11">Đã bán: 0 | Xem: 20</div>
				</td>

				<td class="textR">5,400,000 đ</td>


				<td class="textC">01-01-1970</td>

				<td class="option textC">
					<a class="tipE" title="Gán là nhạc tiêu biểu" href="">
						<img src="{{ URL::asset('contents/images/icons/color/star.png') }}">
					</a>
					<a title="Xem chi tiết sản phẩm" class="tipS" target="_blank" href="product/view/9.html">
						<img src="{{ URL::asset('contents/images/icons/color/view.png') }}">
					</a>
					<a class="tipS" title="Chỉnh sửa" href="admin/product/edit/9.html">
						<img src="{{ URL::asset('contents/images/icons/color/edit.png') }}">
					</a>

					<a class="tipS verify_action" title="Xóa" href="admin/product/del/9.html">
						<img src="{{ URL::asset('contents/images/icons/color/delete.png') }}">
					</a>
				</td>
			</tr>
			<!-- End a row of table -->
		</tbody>
	</table>
	<!-- End table -->
</div>
@endsection