@extends('layouts.app')

@section('head.title', webname('Liên hệ'))

@section('contents')
<div class="content-group">
	<!-- BEGIN GROUP-HEAD DETAIL PRODUCT -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived">
				<a href="../gioi-thieu">Liên hệ</a>
				<span class="triangle"></span>
			</li>
		</ul>
	</div>
	<!-- END GROUP-HEAD DETAIL PRODUCT -->

	<!-- BEGIN CONTENT-GROUP-BODY -->
	<div class="content-group-body" style="width: 95%; margin: 20px auto;">
		<h4>Bản đồ:</h4>
		<iframe src="https://www.google.com/maps/d/embed?mid=zq-BhDbZBjsA.kLNnlvH2cY9w" style="width: 100%; height: 500px; margin: 0 auto;"></iframe>	
	</div>
</div>
@endsection