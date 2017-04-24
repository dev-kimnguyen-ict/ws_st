<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>{{ $title }}</title>
    <meta name="robots" content="noindex, nofollow"/>

    <!-- <link rel="shortcut icon" href="images/icon.png" type="image/x-icon"/> -->
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" media="screen" />
    <link rel="stylesheet" href="{{ asset('css/nprogress.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('contents/crown/css/main.css') }}" media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('contents/css/css.css') }}" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/dothosontuyet.admin.css') }}" media="screen" />
    @yield('head.styles')
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/nprogress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    @yield('head.scripts')
    
</head>
<body style="display: none;">
    <!-- Side bar container -->
    <div id="left_content">
        <!-- Sidebar -->
        <div id="leftSide" style="padding-top: 30px;">
            @include('admin.struct.navigation')
        </div>
        <!-- End side bar -->
    </div>
    <!-- End sidebar container -->

    <!-- Content container -->
    <div id="rightSide">

        <!-- Top bar -->
        <div class="topNav">
            <div class="wrapper">
                @include('admin.struct.topbar')
            </div>
        </div>
        <!-- End top bar -->
        
        @yield('script')
        
        <!-- Title top bar -->
        <div class="titleArea">
            <div class="wrapper">

                <!-- Page title -->
                <div class="pageTitle">
                    <h5>{{ $title }}</h5>
                    <span>{{ $subTitle }}</span>
                </div>

                <!-- Menu action -->
                <div class="horControlB menu_action">
                    <ul>
                        @yield('content.menuaction')
                    </ul>
                </div>

                <div class="clear"></div>
            </div>
        </div>
        <!-- End title top bar -->
        
        <div class="line"></div>

        <!-- Main content -->
        <div class="wrapper">

            <!-- Content -->
            <div class="widgets">
                @yield('content')
            </div>
            <!-- End content -->

         </div>
         <!-- End main content -->

         <div class="clear mt30"></div>

         <!-- Footer -->
         <div id="footer">
            <div class="wrapper">
                <div>Bản quyền &copy; 2016 - Nguyễn Hữu Kim</div>
            </div>
        </div>
        <!-- End footer -->

</div>
<!-- End content container -->
<div class="notify" style="display: none;">
    <span class="notify-message"></span>
    <i class="fa fa-close"></i>
</div>
<script>
    $('body').show();
    // NProgress.set(0.9);
    NProgress.start();
    setTimeout(function() {
        NProgress.done();
    }, 800);
</script>
</body>
</html>