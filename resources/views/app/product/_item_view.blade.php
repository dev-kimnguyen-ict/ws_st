<?php $detailUrl = route('app.product.detail', [$product->category->seo->alias, $product->seo->alias.SUBFIX]); ?>
<!-- ITEM -->
<div class="col-xs-6 col-md-3">
	<div class="item">
		<a href="{{ $detailUrl }}">
			<img src="{{ asset($product->thumb) }}" class="img-thumbnail" />
		</a>
		<a class="item-title" href="{{ $detailUrl }}">
			{{ $product->name }}
		</a>
		<span class="item-price">{{ number_format($product->price) }} VNĐ</span>
		
		<div class="btn-group item-action">
			<a href="{{ $detailUrl }}" class="btn btn-xs btn-default btn-detail">
				Xem chi tiết
			</a>
			{!! Form::open([
					'route' => 'app.cart.insert',
					'method' => 'PUT'
				])
			!!}
			<a 	href="javascript:void(0);" class="btn btn-xs btn-buy btn-insert-cart" 
				id-bind-insert-cart="{{ $product->id }}">
				<i class="fa fa-cart-plus icon"></i>Thêm vào
			</a>
			{!! Form::close() !!}
		</div>
	</div>
</div>
<!-- END ITEM -->