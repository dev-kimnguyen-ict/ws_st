<div class="content-group">

	<!-- BEGIN CONTENT-GROUP-HEAD -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived text-uppercase">
				<a href="javascript:void (0);">Thông tin giỏ hàng</a>
				<span class="triangle"></span>
			</li>
		</ul>
	</div>
	<!-- END CONTENT-GROUP-HEAD -->

	<?php $cart = Session::get(SS_CART, null); ?>

	<!-- BEGIN CONTENT-GROUP-BODY -->
	<div class="content-group-body">
	@if(!empty($cart))
	<table class="table table-striped table-hover table-bordered">
		<thead>
			<tr class="primary">
				<th>STT</th>
				<th>Thumbnail</th>
				<th>Tên sản phẩm</th>
				<th>Số lượng mua</th>
				<th>Thành tiền (VNĐ)</th>
				<th>Tùy chọn</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 0; ?>
			@foreach($cart as $product)
			<?php
				$detailUrl = route('app.product.detail', [$product->category->seo->alias, $product->seo->alias, SUBFIX]);
			?>
			<tr id="tr-{{ $product->id }}">
				<td>{{ ++$i }}</td>
				<td>
					<a href="{{ $detailUrl }}">
						<img src="{{ asset($product->thumb) }}" alt="{{ asset($product->thumb) }}"
							 title="{{ $product->name }}" style="width: 50px; height: 50px;" />
					</a>
				</td>
				<td>
					<a href="{{ $detailUrl }}" style="color: black; text-decoration: none;">
						{{ $product->name }}
					</a>
				</td>
				<!--Thêm tính năng thay đổi số lượng sản phẩm bằng ajax-->
				<td>
					{!! Form::open([
							'route' => 'app.cart.update',
							'method' => 'PUT',
							'onSubmit' => 'return false;'
						])
					!!}
					<input 	type="number" id-bind-quatity="{{ $product->id }}"
							name="new_quatity" size="10" class="input-quatity" value="{{ $product->getQuatity() }}" />
					{!! Form::close() !!}
				</td>
				<td id="price-{{ $product->id }}">
					{{ number_format($product->getAmount()) }}
				</td>
				<td>
					{!! Form::open([
							'route' => 'app.cart.remove',
							'method' => 'DELETE'
						])
					!!}
					<a class="remove-item-action" href="javascript:void(0);" id-bind-item="{{ $product->id }}">Xóa</a>
					{!! Form::close() !!}
				</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td class="danger">Tổng đơn giá: </td>
			<td class="danger" id="sum-price">{{ number_format(Session::get(SS_CART)->sum('amount')) }}</td>
			<td></td>
		</tr>
	</tfoot>
</table>
<div class="order-action btn-group-padding" style="text-align: center;">
	{!! Form::open([
			'route' => 'app.cart.destroy',
			'method' => 'DELETE'
		])
	!!}
	<button type="submit" class="btn btn-default btn-delete-cart">Hủy giỏ hàng</button>
	<a href="javascript:window.history.back();" class="btn btn-info">Tiếp tục mua hàng</a>
	@if(Auth::guest())
	<a href="javascript:void(0);" class="btn btn-warning" id="dat-hang" check-bind-dat-hang="1">
		Đặt hàng và thanh toán
	</a>
	@elseif(isMember())
	<a href="{{ route('app.order.checkout', SUBFIX) }}" name="customer_info" type="submit" 
							class="btn btn-default primary-custom btn-warning"
							style="border: none;">Đặt hàng và thanh toán</a>
	@endif
	{!! Form::close() !!}
</div>
		@else
			<h4 style="margin: 20px; text-align: center;">Giỏ hàng của bạn hiện chưa có sản phẩm nào!</h4>
			<p style="text-align: center;">Mời bạn thăm quan cửa hàng và mua sắm!</p>
		@endif
	</div>
	<!-- END CONTENT-GROUP-BODY -->

	<!-- BEGIN CONTENT-GROUP-FOOT -->
	<div class="content-group-foot">

	</div>
	<!-- END CONTENT-GROUP-FOOT -->	

</div>
<!-- END GIỎ HÀNG -->