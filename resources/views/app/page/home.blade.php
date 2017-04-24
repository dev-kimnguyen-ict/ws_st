@extends('layouts.app')

@section('head.title', WEB_NAME)

@section('contents')	
<!-- BEGIN SẢN PHẨM MỚI | SẢN PHẨM NỔI BẬT -->
<div class="content-group border-bottom">
	<!-- BEGIN CONTENT-GROUP-HEAD -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived toggle_new text-uppercase">
				<a href="javascript:void(0);" >Sản phẩm mới</a>
				<span class="triangle"></span>
			</li>
			<li class="toggle_featured text-uppercase">
				<a href="javascript:void(0);">Sản phẩm nổi bật</a>
				<span class="triangle hidden"></span>
			</li>
		</ul>
	</div>
	<!-- END CONTENT-GROUP-HEAD -->

	<!-- BEGIN NEW PRODUCT TAB -->
	@if(isset($newProducts))
	<div class="content-group-body new-product">
		<div class="row">
			@foreach($newProducts as $position => $product)
				@include('app.product._item_view')
			@endforeach
		</div>
	</div>
	<div class="content-group-foot new-product">
		<a href="{{ route('app.product.category', ['san-pham-moi', SUBFIX]) }}" class="view-all">Xem tất cả</a>
	</div>
	@endif
	<!-- END NEW PRODUCT TAB -->

	<!-- BEGIN CONTENT-GROUP-BODY -->
	@if(isset($feaProducts))
	<div class="content-group-body featured-product hidden">
		<div class="row">
			@foreach($feaProducts as $position => $product)
				@include('app.product._item_view')
			@endforeach
		</div>
	</div>

	<div class="content-group-foot featured-product hidden">
		<a href="{{ route('app.product.category', ['san-pham-noi-bat', SUBFIX]) }}" class="view-all">Xem tất cả</a>
	</div>
	@endif
</div>

<!-- END SẢN PHẨM MỚI | SẢN PHẨM NỔI BẬT -->
@if(isset($categories))
	<?php $take = 8; ?>
	@foreach($categories as $position => $category)
		@if(count($category->products) > 0)
		<!-- HIỂN THỊ THEO DANH MỤC -->
		<div class="content-group border-bottom">
			<div class="content-group-head">
				<ul>
					<li class="title-actived text-uppercase">
						<a href="#">{{ $category->name }}</a>
						<span class="triangle"></span>
					</li>
				</ul>
			</div>
			<div class="content-group-body">
				<div class="row">
					@foreach($category->products->take($take) as $product)
						@include('app.product._item_view')
					@endforeach
				</div>
			</div>

			<div class="clearfix"></div>

			<!-- BEGIN CONTENT-GROUP-FOOT -->
			<div class="content-group-foot">
				@if($category->products->count() > $take)
				<a href="{{ route('app.product.category', $category->seo->alias) }}" class="view-all">Xem tất cả</a>
				@endif
			</div>
		</div>
		<!-- END CONTENT -->
		@endif
	@endforeach
@endif
@endsection	