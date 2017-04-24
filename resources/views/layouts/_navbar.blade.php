<div class="container">
    <nav class="navigation">
        <div class="navigation-container container navbar navbar-inverse">

            <div class="menu-border-left">&nbsp</div>

            <div class="collapse navbar-collapse" id="menu-collapse">
                <ul class="main-menu nav navbar-nav">
                    <li class="text-uppercase menu-actived">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i></a>
                    </li>
                    @if(isset($categories))
                        @foreach($categories->where('parentid', null) as $category)
                        <?php $submenu = $category->categories->count() ?>
                        <li class="dropdown text-uppercase">
                            <a href="{{ route('app.product.category', $category->seo->alias, SUBFIX) }}">{{ $category->name }}
                                @if($submenu > 0)
                                    &nbsp;<span class="caret icon-caret"></span>
                                @endif
                            </a>
                            @if($submenu > 0)
                            {!! submenu($category->categories, $category->id) !!}
                            @endif
                        </li>
                        @endforeach
                    @endif
                    <li class="text-uppercase">
                        <a href="{{ route('app.page.about', SUBFIX) }}">Giới thiệu</a>
                    </li>
                    <li class="text-uppercase">
                        <a href="{{ route('app.page.contact', SUBFIX) }}">Liên hệ</a>
                    </li>
                </ul>
            </div>

            <div class="menu-border-right">&nbsp</div>

        </div>
    </nav>
</div>