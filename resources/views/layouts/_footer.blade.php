<div class="container-footer center-block">
	@if(isset($categories))
		@foreach($categories->take(3) as $category)
		<?php $detailUrl = route('app.product.category', [$category->seo->alias, SUBFIX]) ?>
		<!--BEGIN FOOTER CONTENT-->
		<div class="footer-content">
			<a href="{{ $detailUrl }}">
				<h3 class="footer-title">{{ $category->name }}</h3>
			</a>
			<ul class="footer-list">
			@foreach($category->categories as $child)
				<li>
					<a href="{{ $detailUrl }}">
						{{ $child->name }}
					</a>
				</li>
			@endforeach
			</ul>
		</div>
		<!--END FOORER CONTENT-->
		@endforeach
	@endif

	<!--BEGIN FOOTER CONTENT-->
	<div class="footer-content">
		<a href="#"><h3 class="footer-title">{{ WEB_NAME }}</h3><a/>
		<ul class="footer-list">
			<li><a href="javascript:void(0);">Hotline: {{ WEB_HOTLINE }}</a></li>
			<li><a href="javascript:void(0);">Email: {{ WEB_SUPPORT_EMAIL }}</a></li>
			<li><a href="javascript:void(0);">Facebook: {{ WEB_NAME }}</a></li>
			<li class="special"><a href="javascript:void(0);">Địa chỉ: {{ WEB_ADDRESS }}</a></li>
			<li><a href="javascript:void(0);">Administrator:  {{ WEB_ADMIN_NAME }}</a></li>
			<li><a href="javascript:void(0);">Hỗ trợ kỹ thuật: {{ WEB_ADMIN_EMAIL }}</a></li>
		</ul>
	</div>
	<!--END FOOTER CONTENT-->
</div>
<!--END CONTAINER-->

	<div class="clearfix"></div>
	<div class="copyright text-center">Copyright © 2015, All Right Reserved - Powered by KIMIT.</div>