<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <base href="../" />
        <meta charset="utf-8" />
        <meta name="author" content="Softnio" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers." />
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.png') }}" />
        <!-- Page Title  -->
        <title>@yield('title','')</title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.3.0') }}" />
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.3.0') }}" />
    </head>

    <body class="nk-body bg-lighter npc-default has-sidebar">
        <div class="nk-app-root">
            <!-- main  -->
            <div class="nk-main">
                <!-- sidebar  -->
                <div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-sidebar-brand">
                            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                                <img class="logo-light logo-img" src="{{ asset('assets/images/icons/logo.png') }}" srcset="{{ asset('assets/images/icons/logo2x.png 2x') }}" alt="logo" />
                                <img class="logo-dark logo-img" src="{{ asset('assets/images/icons/logo-dark.png') }}" srcset="{{ asset('assets/images/icons/logo-dark2x.png 2x') }}" alt="logo-dark" />
                                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/images/icons/logo-small.png') }}" srcset="{{ asset('assets/images/icons/logo-small2x.png 2x') }}" alt="logo-small" />
                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                    </div>
                    <!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                    <!-- .nk-menu-heading -->
                                    <li class="nk-menu-item has-sub {{ Request::is('home*')?'active':'' }}">
                                        <a href="{{ route('home') }}" class="nk-menu-link ">
                                            <span class="nk-menu-icon"><em class="icon ni ni-app"></em></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <!-- .nk-menu-heading -->
                                    <li class="nk-menu-item has-sub {{ Request::is('orders*')?'active':'' }}">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span>
                                            <span class="nk-menu-text">Orders</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item {{ Request::is('orders*')?'active':'' }}">
                                                <a href="{{ route('orders.index') }}" class="nk-menu-link "><span class="nk-menu-text">Orders</span></a>
                                            </li>
                                            
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cart"></em></span>
                                            <span class="nk-menu-text">Products</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="html/user-list-default.html" class="nk-menu-link"><span class="nk-menu-text">Products</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                            <span class="nk-menu-text">Stores</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="html/user-list-default.html" class="nk-menu-link"><span class="nk-menu-text">Stores</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-bus-front-12"></em></span>
                                            <span class="nk-menu-text">Curior Companies</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="html/user-list-default.html" class="nk-menu-link"><span class="nk-menu-text">Curior Companies</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="#" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-bus-front-12"></em></span>
                                            <span class="nk-menu-text">Settings</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="html/user-list-default.html" class="nk-menu-link"><span class="nk-menu-text">Users</span></a>
                                            </li>
                                            <li class="nk-menu-item">
                                                <a href="html/user-list-default.html" class="nk-menu-link"><span class="nk-menu-text">Add Store</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <!-- .nk-menu-item -->
                                </ul>
                                <!-- .nk-menu -->
                            </div>
                            <!-- .nk-sidebar-menu -->
                        </div>
                        <!-- .nk-sidebar-content -->
                    </div>
                    <!-- .nk-sidebar-element -->
                </div>
                <!-- sidebar  -->
                <!-- wrap  -->
                <div class="nk-wrap">
                    <!-- main header  -->
                    <div class="nk-header nk-header-fixed is-light">
                        <div class="container-fluid">
                            <div class="nk-header-wrap">
                                <div class="nk-menu-trigger d-xl-none ml-n1">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                                </div>
                                <div class="nk-header-brand d-xl-none">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('assets/images/icons/logo.png') }}" srcset="{{ asset('assets/images/icons/logo2x.png 2x') }}" alt="logo" />
                                        <img class="logo-dark logo-img" src="{{ asset('assets/images/icons/logo-dark.png') }}" srcset="{{ asset('assets/images/icons/logo-dark2x.png 2x') }}" alt="logo-dark" />
                                    </a>
                                </div>
                                <!-- .nk-header-brand -->
                                <div class="nk-header-search ml-3 ml-xl-0">
                                    <em class="icon ni ni-search"></em>
                                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything" />
                                </div>
                                <!-- .nk-header-news -->
                                <div class="nk-header-tools">
                                    <ul class="nk-quick-nav">
                                        {{-- <li class="dropdown chats-dropdown hide-mb-xs">
                                            <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                                <div class="icon-status icon-status-na"><em class="icon ni ni-comments"></em></div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                <div class="dropdown-head">
                                                    <span class="sub-title nk-dropdown-title">Recent Chats</span>
                                                    <a href="#">Setting</a>
                                                </div>
                                                <div class="dropdown-body">
                                                    <ul class="chat-list">
                                                        <li class="chat-item">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar">
                                                                    <span>IH</span>
                                                                    <span class="status dot dot-lg dot-gray"></span>
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">Iliash Hossain</div>
                                                                        <span class="time">Now</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">You: Please confrim if you got my last messages.</div>
                                                                        <div class="status delivered">
                                                                            <em class="icon ni ni-check-circle-fill"></em>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                        <li class="chat-item is-unread">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar bg-pink">
                                                                    <span>AB</span>
                                                                    <span class="status dot dot-lg dot-success"></span>
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">Abu Bin Ishtiyak</div>
                                                                        <span class="time">4:49 AM</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">Hi, I am Ishtiyak, can you help me with this problem ?</div>
                                                                        <div class="status unread">
                                                                            <em class="icon ni ni-bullet-fill"></em>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                        <li class="chat-item">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar">
                                                                    <img src="{{ asset('assets/images/avatar/b-sm.jpg') }}" alt="" />
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">George Philips</div>
                                                                        <span class="time">6 Apr</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">Have you seens the claim from Rose?</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                        <li class="chat-item">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar user-avatar-multiple">
                                                                    <div class="user-avatar">
                                                                        <img src="{{ asset('assets/images/avatar/c-sm.jpg') }}" alt="" />
                                                                    </div>
                                                                    <div class="user-avatar">
                                                                        <span>AB</span>
                                                                    </div>
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">Softnio Group</div>
                                                                        <span class="time">27 Mar</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                        <div class="status sent">
                                                                            <em class="icon ni ni-check-circle"></em>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                        <li class="chat-item">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar">
                                                                    <img src="{{ asset('assets/images/avatar/a-sm.jpg') }}" alt="" />
                                                                    <span class="status dot dot-lg dot-success"></span>
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">Larry Hughes</div>
                                                                        <span class="time">3 Apr</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">Hi Frank! How is you doing?</div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                        <li class="chat-item">
                                                            <a class="chat-link" href="html/apps-chats.html">
                                                                <div class="chat-media user-avatar bg-purple">
                                                                    <span>TW</span>
                                                                </div>
                                                                <div class="chat-info">
                                                                    <div class="chat-from">
                                                                        <div class="name">Tammy Wilson</div>
                                                                        <span class="time">27 Mar</span>
                                                                    </div>
                                                                    <div class="chat-context">
                                                                        <div class="text">You: I just bought a new computer but i am having some problem</div>
                                                                        <div class="status sent">
                                                                            <em class="icon ni ni-check-circle"></em>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <!-- .chat-item -->
                                                    </ul>
                                                    <!-- .chat-list -->
                                                </div>
                                                <!-- .nk-dropdown-body -->
                                                <div class="dropdown-foot center">
                                                    <a href="html/apps-chats.html">View All</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dropdown notification-dropdown">
                                            <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                                                <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right">
                                                <div class="dropdown-head">
                                                    <span class="sub-title nk-dropdown-title">Notifications</span>
                                                    <a href="#">Mark All as Read</a>
                                                </div>
                                                <div class="dropdown-body">
                                                    <div class="nk-notification">
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-notification-item dropdown-inner">
                                                            <div class="nk-notification-icon">
                                                                <em class="icon icon-circle bg-success-dim ni ni-curve-down-left"></em>
                                                            </div>
                                                            <div class="nk-notification-content">
                                                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                                                <div class="nk-notification-time">2 hrs ago</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- .nk-notification -->
                                                </div>
                                                <!-- .nk-dropdown-body -->
                                                <div class="dropdown-foot center">
                                                    <a href="#">View All</a>
                                                </div>
                                            </div>
                                        </li> --}}
                                        <li class="dropdown user-dropdown">
                                            <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                                <div class="user-toggle">
                                                    <div class="user-avatar sm">
                                                        <em class="icon ni ni-user-alt"></em>
                                                    </div>
                                                    <div class="user-info d-none d-xl-block">
                                                        <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            <span>AB</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">{{ Auth::user()->name }}</span>
                                                            <span class="sub-text">{{ Auth::user()->email }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        {{-- <li>
                                                            <a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a>
                                                        </li>
                                                        <li>
                                                            <a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a>
                                                        </li> --}}
                                                        <li>
                                                            <a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        <li>
                                                            <a
                                                                class="dropdown-item"
                                                                href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                            >
                                                                <em class="icon ni ni-signout"></em><span>Sign out</span>
                                                            </a>

                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                                @csrf
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- .nk-header-wrap -->
                        </div>
                        <!-- .container-fliud -->
                    </div>
                    <!-- main header  -->
                    <!-- content  -->
                    <div class="nk-content">
                        <div class="container-fz`luid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-between">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">@yield('page-title','')</h3>
                                            </div>
                                            <!-- .nk-block-head-content -->

                                            <!-- .nk-block-head-content -->
                                        </div>
                                        <!-- .nk-block-between -->
                                    </div>
                                    <!-- .nk-block-head -->
                                    <div class="nk-block">
                                        {{--
                                        <div class="row g-gs">
                                            <div class="col-xxl-12 col-sm-12">
                                                --}}
                                                <div class="card">
                                                    @yield('content')
                                                    <!-- .nk-ecwg -->
                                                    {{--
                                                </div>
                                                <!-- .card -->
                                            </div>
                                            --}}
                                            <!-- .col -->
                                        </div>
                                        <!-- .row -->
                                    </div>
                                    <!-- .nk-block -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content  -->
                    <!-- footer  -->
                    <div class="nk-footer">
                        <div class="container-fluid">
                            <div class="nk-footer-wrap">
                                <div class="nk-footer-copyright">&copy; 2020 DashLite. Template by <a href="https://softnio.com" target="_blank">Softnio</a></div>
                                <div class="nk-footer-links">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- footer  -->
                </div>
                <!-- wrap  -->
            </div>
            <!-- main  -->
        </div>
        <!-- app-root  -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/js/bundle.js?ver=2.3.0') }}"></script>
        <script src="{{ asset('assets/js/scripts.js?ver=2.3.0') }}"></script>
        <script src="{{ asset('assets/js/charts/chart-ecommerce.js?ver=2.3.0') }}"></script>
        @yield('script')
    </body>
</html>
