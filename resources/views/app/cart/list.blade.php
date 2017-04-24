@extends('layouts.app')

@section('head.title', webname('Giỏ hàng'))

@section('contents')
<!-- BEGIN FORM ĐẶT HÀNG -->
<div class="content-group" id="form-dat-hang" style="display: none;">
	<!-- BEGIN CONTENT-GROUP-HEAD -->
	<div class="content-group-head">
		<ul>
			<li class="title-actived text-uppercase">
				<a href="javascript:void (0);">Đặt hàng và thanh toán</a>
				<span class="triangle"></span>
			</li>
		</ul>
	</div>
	<!-- END CONTENT-GROUP-HEAD -->

	<!-- BEGIN CONTENT-GROUP-BODY -->
	<div class="content-group-body">
		<div class="row">
			<div class="col-xs-12 steps">
				<ul class="row-fluid">
					<li class="col-xs-3">
						<a class="step">
							<span class="number done">1</span>
							<span class="desc"><i class="fa fa-check"></i> Chọn sản phẩm</span>
						</a>
					</li>
					<li class="col-xs-3">
						<a class="step">
							<span class="number done">2</span>
							<span class="desc"><i class="fa fa-check"></i> Xác nhận giỏ hàng</span>
						</a>
					</li>
					<li class="col-xs-3">
						<a class="step">
							<span class="number">3</span>
							<span class="desc"><i class="fa fa-check hidden"></i> Nhập thông tin</span>
						</a>
					</li>
					<li class="col-xs-3">
						<a class="step">
							<span class="number">4</span>
							<span class="desc"><i class="fa fa-check hidden"></i> Đặt hàng</span>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
				<div class="progress" style="margin-left: 20px; margin-right: 20px;">
					<div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 50%"></div>
					<div class="progress-bar progress-bar-warning" style="width: 25%"></div>
				</div>
			</div>
		
			<!-- BEGIN FORM MUA HÀNG -->
			<div class="col-xs-12 mua-hang">
				<p><i>Quý khách vui lòng ĐĂNG NHẬP để bỏ qua bước này hoặc điền đầy đủ thông tin vào mẫu dưới đây để tiếp tục.</i></p>
				{!! Form::open([
				        'route'     => 'app.order.postCustomer',
				        'method'    => 'POST'
				    ])
				!!}
					<div class="form-group">
						<label for="fullname">Họ và tên:</label>
						<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Họ và tên" />

						<label for="address">Địa chỉ:</label>
						<input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" />

							<!--label for="cmtnd">CMND:</label>
							<input type="text" class="form-control" id="cmtnd" name="cmtnd" placeholder="Số chứng minh thư nhân dân" /-->

						<label for="phone">Số điện thoại:</label>
						<input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" />

						<label for="email">Email:</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="Email của bạn" />
					</div>

					<!--div class="input-group">
						<label>Hình thức thanh toán:&nbsp</label>
						
						<input type="radio" id="nganhang" name="hinhthuc" checked="true"/>
						<label for="nganhang">Ngân hàng</label>

						<input type="radio" id="buudien" name="hinhthuc" />
						<label for="buudien">Bưu điện</label>

						<input type="radio" id="khac" name="hinhthuc" />
						<label for="khac">Khác</label>
					</div-->

					<div class="form-group">
						<label for="note">Ghi chú:</label>
						<textarea class="form-control" name="note" id="note" cols="100%" rows="10" placeholder="Ghi chú khi giao hàng"></textarea>
					</div>

					<div class="form-group-foot">
						<div class="pull-right">
							<button name="customer_info" type="submit" class="btn btn-default primary-custom" style="border: none;">Đặt hàng ngay</button>
							<button type="reset" class="btn btn-default">Nhập lại</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
			<!-- END FORM MUA HÀNG -->
		</div>
	</div>
	<!-- END CONTENT-GROUP-BODY -->

	<!-- BEGIN CONTENT-GROUP-FOOT -->
	<div class="content-group-foot">

	</div>
	<!-- END CONTENT-GROUP-FOOT -->	
</div>
<!-- END CONTENT -->

<!-- Danh sách giỏ hàng -->
@include('app.cart._cart')
<!-- End danh sách -->
@endsection