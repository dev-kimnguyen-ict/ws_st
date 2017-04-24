@extends('layouts.app')

@section('head.title', isset($product) ? $product->name : 'Chi tiết sản phẩm')

@section('contents')
<!-- BEGIN CONTENT-GROUP :::: DETAIL PRODUCT -->
<div class="content-group border-bottom">
	
	<!-- BEGIN GROUP-HEAD DETAIL PRODUCT -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived">
				<a href="javascript:void (0);">{{ $product->name }}</a>
				<span class="triangle"></span>
			</li>
		</ul>
	</div>
	<!-- END GROUP-HEAD DETAIL PRODUCT -->

	<!-- BEGIN CONTENT-GROUP-BODY : IMAGES -->
	<div class="content-group-body">
		<div class="row">
			@section('head.styles')
			@parent
			<link rel="stylesheet" href="{{ asset('slide-detail/engine1/style.css') }}" />
			@endsection
			<!-- PREVIEW PRODUCT - SLIDESHOW -->
			<div class="col-xs-12 col-md-6 preview">
				<div class="frame-img-big">
					<div>
						<img src="{{ asset($product->images->get(0)->url) }}" 
							 alt="{{ asset($product->images->get(0)->url) }}"
							 title="{{ $product->name }}" />
					</div>
				</div>
				<div>
					<!-- Danh sach hinh anh -->
					@foreach($product->images as $image)
						<a href="javascript:void(0)" class="images-list">
							<img src="{{ asset($image->url) }}" alt="{{ $product->name }}" class="image-thumb" />
						</a>
					@endforeach

					@section('head.scripts')
					@parent()
					<script>
						$(function() {
							$('.images-list').click(function () {
								var $img = $(this).find('img');
								var url = $img.attr('src');
								var img = '<img src="' + url + '" class="preview-image" />'
								$('body').append('<div id="over">' + img);
								$('#over').show();
							});

							$(document).on('click', '#over', function () {
								$('#over, #over img').remove();;
							});
						});
					</script>
					@endsection
				</div>
			</div>
			<!-- END PREVIEW PRODUCT -->

			<!-- BEGIN PRODUCT INFOMATION -->
			<div class="col-xs-12 col-md-6 product-infomation">
				<h1 class="product-title">{{ $product->name }}</h1>
				<ul class="product-title-foot">
					<li>Lượt xem: <span>{{ $product->viewed }}</span></li>
					<li>Ngày đăng: <span>{{ $product->created_at }}</span></li>
				</ul>

				<div class="clearfix"></div>

				<div class="product-price-box">
					<ul>
						<li>Giá sản phẩm: 
							<span class="product-price">
								{{ number_format($product->price) . ' VNĐ' }}
							</span>
						</li>
						<li>Bảo hành: <span class="product-baohanh">6 tháng</span></li>
					</ul>
				</div>
				<div class="product-action">
					<p>Phí vận chuyển: <span class="product-price-vanchuyen">Liên hệ</span></p>
					<a href="javascript:void(0);" id-bind-insert-cart="{{ $product->id }}"
						check-bind-buy="1" class="btn btn-buy-product">Đặt hàng ngay</a>
						<a href="javascript:void(0);" id-bind-insert-cart="{{ $product->id }}"
							class="btn btn-add-product">Thêm vào giỏ hàng</a>
						</div>

						<p><i class="fa fa-check-square-o"></i> Nhận đặt hàng theo yêu cầu.</p>
						<p><i class="fa fa-check-square-o"></i> Hãy liên hệ ngay với chúng tôi để được tư vấn miễn phí!</p>
						<p><i class="fa fa-check-square-o"></i> Nếu bạn ngại đặt hàng, hãy liên hệ để mua hàng.</p>
						<div class="ho-tro">
							<p>
								<i class="fa fa-phone-square"></i>
								<span class="phone-number"> 0932-147-596</span> | <span class="phone-number">{{ WEB_HOTLINE }}</span>
							</p>
						</div>
					</div>
					<!-- END PRODUCT INFOMATION -->
				</div>

				<!-- BÀI VIẾT MÔ TẢ -->
				<div class="row">
					<article class="col-xs-12 col-md-12 description">
						<div class="article-title">Thông tin chi tiết</div>
						<div class="article-content">
							@if($product->longdesc)
							{!! $product->longdesc !!}
							@else
								<h4>Chưa cập nhật thông tin chi tiết về sản phẩm "{{ $product->name }}".</h4>
							@endif
						</div>
					</article>
				</div>
				<!-- END BÀI VIẾT MÔ TẢ -->

			</div>
			<!-- END CONTENT-GROUP-BODY -->

		</div>
		<!-- END DETAIL PRODUCT -->
		
		<?php
			$take 		= 16;
			$products 	= $product->category->products->take($take);
		?>
		@if($products->count() > 0)
		<!-- BEGIN SẢN PHẨM LIÊN QUAN -->
		<div class="content-group border-bottom">

			<!-- BEGIN CONTENT-GROUP-HEAD -->
			<div class="content-group-head">
				<ul>
					<li class="title-actived">
						<a href="javascript:void(0);">Sản phẩm cùng danh mục</a>
						<span class="triangle"></span>
					</li>
				</ul>
			</div>
			<!-- END CONTENT-GROUP-HEAD -->

			<!-- BEGIN CONTENT-GROUP-BODY -->
			<div class="content-group-body">
				<div class="row">
					@foreach($products as $product)
						@include('app.product._item_view')
					@endforeach
				</div>
			</div>
			<!-- END CONTENT-GROUP-BODY -->
		
			<!-- BEGIN CONTENT-GROUP-FOOT -->
			<div class="content-group-foot">
				@if($product->count() > $take)
				<a href="{{ route('app.product.category', [$product->category->seo->alias, SUBFIX]) }}" class="view-all">Xem tất cả</a>
				@endif
			</div>
			<!-- END CONTENT-GROUP-FOOT -->
		</div>
		<!-- END SAN PHAM LIEN QUAN -->
		@endif
@endsection