<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="UTF-8"/>
	<title>@yield('head.title')</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/font-face.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/newstyle.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/footer.css') }}"/>

	@yield('head.styles')
</head>
<body>
	<i class="icon-fixed back-to-top fa fa-long-arrow-up" title="Trở về đầu trang"></i>
	<a href="{{ route('app.cart.list', SUBFIX) }}">
		<i class="icon-fixed cart-fixed fa fa-shopping-cart" title="Xem giỏ hàng"></i>
	</a>

	<!-- Popup Cart -->
	@yield('popup.cart')
	<!-- End Popup Cart -->

	<!-- Header -->
	<header class="header">
		<!-- Banner -->
		@include('layouts._banner')
		<!-- End banner -->

		<!-- Navigation -->
		@include('layouts._navbar')
		<!-- End navigation -->
	</header>
	<!-- End header -->

	@yield('slider')

	<!-- Section -->
	<section class="section">
		<div class="container container-section">
			<div class="row">
				<!-- Category -->
				<div class="tool-box col-xs-12 col-sm-4 col-md-3">
					@include('layouts._toolbox')
				</div>
				<!-- End category -->
				
				<!-- Content -->
				<div class="content col-xs-12 col-sm-8 col-md-9">
					@yield('contents')
				</div>
				<!-- End content -->
			</div>
		</div>
	</section>
	<!-- End section -->

	<footer class="footer">
		@include('layouts._footer')
	</footer>

	<!-- BEGIN THÔNG BÁO -->
	<div class="user-notification">
		@include('layouts._notify')
	</div>
	<!-- END THÔNG BÁO -->
	
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/product_tab.js') }}"></script>
	@include('app.cart._script_cart')
	@include('layouts._script_back_to_top')

	@yield('scripts')
</body>
</html>