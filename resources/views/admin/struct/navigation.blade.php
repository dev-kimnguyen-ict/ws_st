<style>
    .nav a:active{background-position: 0 -86px; border-top: 1px solid #657d92;}
</style>

<!-- Profile -->
<div class="sideProfile">
    <a href="#" class="profileFace">
        <img src="{{ URL::asset('contents/images/user.png') }}" alt="Avatar" width="40px,">
    </a>
    <span>Xin chào: <strong>{{ $_auth->getIdentifier() }}!</strong></span>
    <span>{{ Auth::user()->name }}</span>
    <div class="clear"></div>
</div>
<!-- End profile -->

<div class="sidebarSep"></div>

<!-- Menu -->
<ul class="nav" id="menu">

    <li class="home @yield('navbar.active.dashboard')">
        <a class="" href="{{ route('admin.dashboard') }}">
            <span>Bảng điều khiển</span>
            <strong></strong>
        </a>
    </li>
    <!-- <li class="tran @yield('navbar.active.order')">
        <a class=" exp" href="route('admin.order.index') }}">
            <span>Quản lý bán hàng</span>
            <strong>2</strong>
        </a>
        <ul class="sub">
            <li>
                <a href="admin/tran.html">Giao dịch</a>
            </li>
            <li>
                <a href="admin/product_order.html">Đơn hàng sản phẩm</a>
            </li>
        </ul>
    </li-->
    <li class="product @yield('navbar.active.product')">
        <a id="current" class="exp" href="{{ route('admin.product.index') }}">
            <span>Sản phẩm</span>
            <!-- <strong>3</strong> -->
        </a>
        <ul class="sub">
            <li class="this">
                <a href="{{ route('admin.product.create') }}">Thêm sản phẩm</a>
            </li>
            <!-- <li>
                <a href="{{ route('admin.category.index') }}">Danh mục</a>
            </li>
            <li>
                <a href="admin/comment.html">Phản hồi</a>
            </li> -->
        </ul>
    </li>
    <li class="product @yield('navbar.active.category')">
        <a id="current" class="exp" href="{{ route('admin.category.index') }}">
            <span>Danh mục</span>
            <!-- <strong>3</strong> -->
        </a>
        <ul class="sub">
            <li class="this">
                <a href="{{ route('admin.category.create') }}">Thêm danh mục</a>
            </li>
            <!-- <li>
                <a href="{{ route('admin.category.index') }}">Danh mục</a>
            </li>
            <li>
                <a href="admin/comment.html">Phản hồi</a>
            </li> -->
        </ul>
    </li>
    <li class="account @yield('navbar.active.account')">

        <a class=" exp" href="{{ route('admin.account.index') }}">
            <span>Tài khoản</span>
            <!-- <strong>3</strong> -->
        </a>

        <ul class="sub">
            <li>
                <a href="{{ route('admin.account.create') }}">Thêm mới một tài khoản</a>
            </li>
            <li>
                <a href="{{ route('admin.account.filter', ['permiss' => ADMIN]) }}">Quản trị viên</a>
            </li>
            <li>
                <a href="{{ route('admin.account.filter', ['permiss' => USER]) }}">Thành viên</a>
            </li>
            <li>
                <a href="{{ route('admin.account.filter', ['actived' => 0]) }}">Chưa kích hoạt</a>
            </li>
            <li>
                <a href="{{ route('admin.account.filter', ['blocked' => 1]) }}">Đang bị khóa nick</a>
            </li>
           <!--  <li>
                <a href="admin/admin_group.html">Nhóm quản trị</a>
            </li>
            <li>
                <a href="admin/user.html">Thành viên</a> -->
            </li>
        </ul>

    </li>
    <!-- <li class="support @yield('navbar.active.support')">

        <a class="exp" href="admin/support.html">
            <span>Hỗ trợ và liên hệ</span>
            <strong>2</strong>
        </a>

        <ul class="sub">
            <li>
                <a href="admin/support.html">Hỗ trợ</a>
            </li>
            <li>
                <a href="admin/contact.html">Liên hệ</a>
            </li>
        </ul>

    </li>
    <li class="content @yield('navbar.active.content')">

        <a class=" exp" href="route('admin.ui.index') }}">
            <span>Nội dung</span>
            <strong>4</strong>
        </a>

        <ul class="sub">
            <li>
                <a href="admin/slide.html">Slide</a>
            </li>
            <li>
                <a href="admin/news.html">Tin tức</a>
            </li>
            <li>
                <a href="admin/info.html">Trang thông tin</a>
            </li>
            <li>
                <a href="admin/video.html">Video</a>
            </li>
        </ul>
    </li> -->
</ul>
