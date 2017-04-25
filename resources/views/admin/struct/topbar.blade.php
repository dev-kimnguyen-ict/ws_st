<div class="welcome">
    <span>Xin chào: <b>{{ $_auth->getIdentifier() }}!</b></span>
</div>

<div class="userNav">
    <ul>
        <li>
            <a href="{{ url('/') }}">
                <img src="{{ URL::asset('contents/images/icons/light/home.png') }}" style="margin-top:7px;"/>
                <span>Trang chủ</span>
            </a>
        </li>

        <!-- Logout -->
        <li>
            <a href="{{ route('auth.logout') }}">
                <img alt="" src="{{ URL::asset('contents/images/icons/topnav/logout.png') }}"/>
                <span>Đăng xuất</span>
            </a>
        </li>
    </ul>
</div>

<div class="clear"></div>
