@extends('layouts.app')

@section('head.title', webname($title))

@section('contents')
<div class="content-group">
	<!-- BEGIN CONTENT-GROUP-HEAD -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived text-uppercase">
				<a href="javascript:void (0);"> {{ $title }}</a>
				<span class="triangle"></span>
			</li>
		</ul>
	</div>
	<!-- END CONTENT-GROUP-HEAD -->

	<!-- BEGIN CONTENT-GROUP-BODY -->
	<div class="content-group-body">
		<div class="row">
			@if(isset($products) && $products->total() > 0)
				@foreach ($products as $product)
					@include('app.product._item_view')
				@endforeach
			@else
			<h4 style="margin: 20px; text-align: center;">
				Chưa có sản phẩm mới!
			</h4>
			@endif
		</div>
	</div>
	<!-- END CONTENT-GROUP-BODY -->
	
	<div class="content-group-foot">{!! $products->render() !!}</div>
</div>
@endsection