<!-- sidebar -->
<div class="sidebar app-aside" id="sidebar">
    <div class="sidebar-container perfect-scrollbar">
        <nav>
            <!-- start: SEARCH FORM -->
            <div class="search-form">
                <a class="s-open" href="#">
                    <i class="ti-search"></i>
                </a>
                <form class="navbar-form" role="search">
                    <a class="s-remove" href="#" target=".navbar-form">
                        <i class="ti-close"></i>
                    </a>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn search-button" type="submit">
                            <i class="ti-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <!-- end: SEARCH FORM -->
            <!-- start: MAIN NAVIGATION MENU -->
            <div class="navbar-title">
                <span>Main Navigation</span>
            </div>
            <ul class="main-navigation-menu">
                <li class="@if(in_array(Route::current()->getName(),['pages','pagesEdit','pagesAdd'])) active @endif open">
                    <a href="{{ route('pages') }}">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-file"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Страницы </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="@if(in_array(Route::current()->getName(),['portfolio','portfolioAdd','portfolioEdit'])) active @endif open">
                    <a href="{{ route('portfolio') }}">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-briefcase"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Портфолио </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="@if(in_array(Route::current()->getName(),['service','servicesAdd','servicesEdit'])) active @endif open">
                    <a href="{{ route('service') }}">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-wand"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Сервисы </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="@if(in_array(Route::current()->getName(),['people','peopleAdd','peopleEdit'])) active @endif open">
                    <a href="{{ route('people') }}">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-user"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Команда </span>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="@if(in_array(Route::current()->getName(),['upload_files'])) active @endif open">
                    <a href="{{ route('upload_files') }}">
                        <div class="item-content">
                            <div class="item-media">
                                <i class="ti-user"></i>
                            </div>
                            <div class="item-inner">
                                <span class="title"> Загрузка файлов </span>
                            </div>
                        </div>
                    </a>
                </li>

            </ul>
            <!-- end: MAIN NAVIGATION MENU -->


        </nav>
    </div>
</div>
<!-- / sidebar -->
<div class="app-content">
    <!-- start: TOP NAVBAR -->
    <header class="navbar navbar-default navbar-static-top">
        <!-- start: NAVBAR HEADER -->
        <div class="navbar-header">
            <a href="#" class="sidebar-mobile-toggler pull-left hidden-md hidden-lg" class="btn btn-navbar sidebar-toggle" data-toggle-class="app-slide-off" data-toggle-target="#app" data-toggle-click-outside="#sidebar">
                <i class="ti-align-justify"></i>
            </a>
            <a class="navbar-brand" href="{{ route('pages') }}">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Clip-Two"/>
            </a>
            <a href="#" class="sidebar-toggler pull-right visible-md visible-lg" data-toggle-class="app-sidebar-closed" data-toggle-target="#app">
                <i class="ti-align-justify"></i>
            </a>
        </div>
        <!-- end: NAVBAR HEADER -->
        <!-- start: NAVBAR COLLAPSE -->
        <div class="navbar-collapse collapse">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <div class="close-handle visible-xs-block menu-toggler" data-toggle="collapse" href=".navbar-collapse">
                <div class="arrow-left"></div>
                <div class="arrow-right"></div>
            </div>
            <!-- end: MENU TOGGLER FOR MOBILE DEVICES -->
        </div>

    </header>
    <!-- end: TOP NAVBAR -->


    <div class="main-content" >
        @yield('content')
    </div>
</div>