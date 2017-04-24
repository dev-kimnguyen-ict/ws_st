<!-- BEGIN BANNER -->
<div class="bg">
    <div class="container banner">
        <div class="row">
            <!-- LOGO -->
            <div class="col-xs-6">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Sơn Tuyết" class="logo" />
                </a>
                <div style="width: 100%; color: #FE8C19; text-align: center; text-shadow: 1px 1px 10px #FD9D25;">
                    <h1 style="font-size: 26px; margin: 5px; font-weight: 500; text-shadow: none;">
                        {{ WEB_NAME }}
                    </h1>
                    <h2 style="font-size: 14px; margin: 13px; color: #CF7004;">
                        Cơ sở chuyên sản xuất đồ thờ, đồ gỗ mỹ nghệ cao cấp
                    </h2>
                    <p style="font-size: 14px; color: #FE8C19;">
                        Hotline: 0983-898-699 - Làng nghề Canh Nậu, Thạch Thất, HN
                    </p>
                </div>
                <!-- <span class="brand-caption right">Đồ thờ Sơn Tuyết</span> -->
            </div>

            <!-- FORM SEARCH -->
            <div class="search col-xs-6">
                <ul class="login-menu">
                    @if(Auth::guest())
                    <li>
                        <i class="fa fa-pencil-square-o white"></i>&nbsp
                        <a href="{{ route('auth.getRegister') }}">Tạo tài khoản</a>
                    </li>
                    <li>
                        <i class="fa fa-sign-in white"></i>&nbsp
                        <a href="{{ route('auth.getLogin') }}">Đăng nhập</a>
                    </li>
                    @else
                        <li>
                            <i class="fa fa-sign-out white"></i>&nbsp
                            <a href="{{ route('auth.logout') }}">Đăng xuất tài khoản</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">Xin chào, {{ Auth::user()->name }}!</a>
                        </li>
                        @if(isAdmin())
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Trang quản trị</a>
                        </li>
                        @endif
                    @endif
                </ul>

                <div class="cart">
                    <i class="fa fa-shopping-cart white icon"></i>

                    <a href="{{ route('app.cart.list', SUBFIX) }}" style="text-decoration: none; cursor: pointer;">
                        <span class="cart-notification">
                            Giỏ hàng của bạn (<span class="product-number">{{ ($cart = Session::get(SS_CART, null)) == null ? 0 : $cart->sum('quatity') }}</span>) sản phẩm
                        </span>
                    </a>
                </div>

                {!! Form::open([
                        'route'  => 'app.product.search',
                        'method' => 'GET',
                        'class'  => 'form-search'
                    ])
                !!}
                    <div class="input-group input-group-md">
                        {!! Form::text('q', null, [
                                'class'         => 'form-control',
                                'placeholder'   => 'Tìm kiếm sản phẩm'
                            ])
                        !!}
                        <div class="input-group-btn">
                            <button type="submit" class="btn input-submit">Tìm kiếm</button>
                        </div>
                    </div>
                {!! Form::close() !!}

            </div>
            <!-- END FORM SEARCH -->
        </div> 
    </div>
</div>
<!-- END BANNER -->