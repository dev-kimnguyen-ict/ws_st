<!-- BEGIN CATEGORY -->
<div class="container-news">
    <ul class="news-list">
        <li><i class="fa fa-edit white icon"></i>Danh mục sản phẩm</li>
        @if($categories->count() > 0)
            @foreach($categories as $category)
                <li>
                    <a href="{{ route('app.product.category', [$category->seo->alias, SUBFIX]) }}">
                        <i class="fa fa-square icon"></i>{{ $category->name }}
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
</div>
<!-- END CATEGORY -->

<!-- BEGIN NEWS LIST -->
<div class="container-category">
    <ul class="category-list">
        <li><i class="fa fa-pencil-square-o white icon"></i>Danh mục tin tức</li>
        <li><a href="#"><i class="fa fa-square icon"></i>Tin tức xã hội</a></li>
        <li><a href="#"><i class="fa fa-square icon"></i>Văn hóa nghệ thuật</a></li>
    </ul>
</div>
<!-- END NEWS LIST -->

<!-- BEGIN RANDROM PRODUCT -->
<div class="random">
    <h5 class="random-title"><i class="fa fa-random icon"></i>Sản phẩm ngẫu nhiên</h5>
    <div class="random-list border-bottom">
        <div class="row">
            <ul class="col-md-8 col-md-offset-2" style="list-style-type: none;">
                @if($randProducts->count() > 0)
                    @foreach($randProducts as $product)
                        @php
                            $detailUrl = route('app.product.detail', [
                                $product->category->seo->alias,
                                $product->seo->alias, SUBFIX
                            ]);
                        @endphp
                        <li class="item">
                            <a href="{{ $detailUrl }}">
                                <img src="{{ asset($product->thumb) }}" class="img-thumbnail"/>
                            </a>
                            <a href="{{ $detailUrl }}" class="item-title">{{ $product->name }}</a>
                            <span class="item-price">{{ number_format($product->price) . ' VNĐ' }}</span>
                            <div class="btn-group item-action">
                                <a href="{{ $detailUrl }}" class="btn btn-xs btn-default btn-detail">Xem chi tiết</a>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- END RANDROM PRODUCT -->

<!-- BEGIN LOGIN FORM -->
<!-- <div class="container-form border-bottom">
    {!! Form::open([
            'route' => 'auth.postLogin',
            'method' => 'POST'
        ])
    !!}
    <h5 class="login-title">
        <i class="fa fa-sign-in white icon"></i>Thành viên
    </h5>
    @if(Auth::guest())
    <div class="social-auth">
        <a
            href="{{ route('auth.social.redirect', 'facebook') }}"
                class="social-auth-facebook"
                title="Đăng nhập bằng tài khoản facebook"
            ></a>
        <a
            href="{{ route('auth.social.redirect', 'google') }}"
            class="social-auth-google"
            title="Đăng nhập bằng tài khoản Google"
        ></a>
    </div>
    @endif
    <div class="form-group group-padding">
        @if(Auth::guest())

    @if ($errors->has('email'))
        <div class="has-error">
        {{ $errors->first('email') }}
            </div>
            @endif
    {!! Form::email('email', null, [
            'required'         => true,
            'class'         => 'form-control',
            'placeholder'    => 'Email đăng nhập'
        ])
    !!}

    @if ($errors->has('password'))
        <div class="has-error">
        {{ $errors->first('password') }}
            </div>
            @endif
    {!! Form::password('password', [
            'required' => true,
            'class' => 'form-control',
            'placeholder' => 'Mật khẩu'
        ])
    !!}

        <div class="checkbox">
            <label for="remember">
                <input     name="remember" type="checkbox" id="remember"
                        value="{{ old('remember') ? old('remember') : null }}" />&nbspNhớ mật khẩu
                </label>
                @if ($errors->has('remember'))
        <div class="has-error">
        {{ $errors->first('remember') }}
            </div>
            @endif
        </div>

        <button type="submit" name="login" class="btn btn-info btn-sm btn-login">Đăng nhập</button>

        <div class="helpForm">
            <a href="{{ route('auth.getRegister') }}">Đăng ký?</a>&nbsp|&nbsp
                <a href="{{ route('password.getPasswordReset') }}">Quên mật khẩu?</a>
            </div>
            @else
    <div class="item" style="margin-left: 20px;">
        <a href="javascript:void(0;">
            <img class="img-thumbnail" src="{{ asset(Auth::user()->avatar) }}" />
                </a>
            </div>
            <ul>
                <li><a href="#">Thông tin cá nhân</a></li>
                <li><a href="#">Thay đổi mật khẩu</a></li>
            </ul>
            @endif
    </div>
{!! Form::close() !!}
    </div> -->
<!-- END LOGIN FORM -->
