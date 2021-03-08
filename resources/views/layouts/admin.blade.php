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
        <script>
            var url = "{{ url('/') }}";
            var token = "{{ csrf_token() }}";
        </script>
        @yield('style')
    </head>

    <body class="nk-body bg-lighter npc-default has-sidebar">
        <div class="nk-app-root">
            <!-- main  -->
            <div class="nk-main">
                <!-- sidebar  -->
                <div class="nk-sidebar nk-sidebar-fixed is-light" data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-sidebar-brand">
                            <a href="javascript:void(0)" class="logo-link nk-sidebar-logo">
                                @php
                                   $settingExist = App\Models\Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->exists();
                                    if ($settingExist) {
                                        $setting = App\Models\Setting::where('user_id', Auth::user()->id)->orWhere('user_id', Auth::user()->parent_id)->first();
                                    }
                                @endphp
                                @if ($setting->logo != null)
                                
                                <img class="logo-light logo-img" src="{{ asset('uploads/logo/'.$setting->logo) }}" srcset="{{ asset('uploads/logo/'.$setting->logo) }}" alt="logo" />
                                <img class="logo-dark logo-img" src="{{ asset('uploads/logo/'.$setting->logo) }}" srcset="{{ asset('uploads/logo/'.$setting->logo) }}" alt="logo-dark" />
                                <img class="logo-small logo-img logo-img-small" src="{{ asset('uploads/logo/'.$setting->logo) }}" srcset="{{ asset('uploads/logo/'.$setting->logo) }}" alt="logo-small" />
                                @else
                                <img class="logo-light logo-img" src="{{ asset('assets/images/icons/logo.png') }}" srcset="{{ asset('assets/images/icons/logo2x.png 2x') }}" alt="logo" />
                                <img class="logo-dark logo-img" src="{{ asset('assets/images/icons/logo-dark.png') }}" srcset="{{ asset('assets/images/icons/logo-dark2x.png 2x') }}" alt="logo-dark" />
                                <img class="logo-small logo-img logo-img-small" src="{{ asset('assets/images/icons/logo-small.png') }}" srcset="{{ asset('assets/images/icons/logo-small2x.png 2x') }}" alt="logo-small" />
                                @endif
                                @if (isset($setting->expiry_time))
                                    
                                <input type="hidden"  id="expiry_page_time" value="{{ $setting->expiry_time }}">
                                @else
                                <input type="hidden"  id="expiry_page_time" value="900000">
                                    
                                @endif
                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                            <a href="javascript:void(0)" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                    </div>
                    <!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                    <!-- .nk-menu-heading -->
                                    {{-- <li class="nk-menu-item has-sub {{ Request::is('home*')?'active':'' }}">
                                        <a href="{{ route('home') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-app"></em></span> <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                        <!-- .nk-menu-sub -->
                                    </li> --}}
                                    <!-- .nk-menu-heading -->
                                    <li class="nk-menu-item has-sub {{ Request::is('orders*')?'active':'' }}">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb-fill"></em></span> <span class="nk-menu-text">Orders</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            {{-- <li class="nk-menu-item {{ Request::is('orders*')?'active':'' }}">
                                                <a href="{{ route('orders.index') }}" class="nk-menu-link"><span class="nk-menu-text">Orders</span></a>
                                            </li> --}}
                                            @php
                                                $stores = App\Models\Shop::where('user_id',Auth::user()->id)->orWhere('user_id',Auth::user()->parent_id)->get();
                                            @endphp
                                            @foreach ($stores as $store)
                                            <li class="nk-menu-item {{ Request::is('orders*')?'active':'' }}">
                                                <a href="{{ route('orders.index') }}?store={{ encrypt($store->id) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $store->name }}</span></a>
                                            </li>
                                                
                                            @endforeach
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <!-- .nk-menu-item -->
                                    <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cart"></em></span> <span class="nk-menu-text">Products</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @php
                                                $stores = App\Models\Shop::where('user_id',Auth::user()->id)->orWhere('user_id',Auth::user()->parent_id)->get();
                                            @endphp
                                            @foreach ($stores as $store)
                                            <li class="nk-menu-item">
                                                <a href="{{ route('products.index') }}?store={{ encrypt($store->id) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $store->name }}</span></a>
                                            </li>
                                                
                                            @endforeach
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span> <span class="nk-menu-text">Stores</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{ route('stores.index') }}" class="nk-menu-link"><span class="nk-menu-text">Stores</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span> <span class="nk-menu-text">Users</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="{{route('users.index')}}" class="nk-menu-link"> <span class="nk-menu-text">Users</span> </a>
                                                <!-- .nk-menu-sub -->
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    {{-- <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-delivery-fast"></em></span> <span class="nk-menu-text">Curior Companies</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="javascript:void(0)" class="nk-menu-link"><span class="nk-menu-text">Curior Companies</span></a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span> <span class="nk-menu-text">Store Settings</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            @foreach ($stores as $store)
                                                
                                            <li class="nk-menu-item">
                                                <a href="{{ route('store-settings.index') }}?store={{ encrypt($store->id) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $store->name }}</span></a>
                                            </li>
                                            @endforeach
                                            
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    @if (Auth::user()->role != 'Staff')
                                    <li class="nk-menu-item has-sub">
                                        <a href="javascript:void(0)" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span> <span class="nk-menu-text">Settings</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item">
                                                <a href="{{ route('settings.index') }}" class="nk-menu-link"><span class="nk-menu-text">Default Settings</span></a>
                                            </li>
                                        </ul>
                                        <!-- .nk-menu-sub -->
                                    </li>
                                    @endif
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
                                    <a href="javascript:void(0)" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                                </div>
                                <div class="nk-header-brand d-xl-none">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('assets/images/icons/logo.png') }}" srcset="{{ asset('assets/images/icons/logo2x.png 2x') }}" alt="logo" />
                                        <img class="logo-dark logo-img" src="{{ asset('assets/images/icons/logo-dark.png') }}" srcset="{{ asset('assets/images/icons/logo-dark2x.png 2x') }}" alt="logo-dark" />
                                    </a>
                                </div>
                                <!-- .nk-header-brand -->
                                <!-- .nk-header-news -->
                                <div class="nk-header-tools">
                                    <ul class="nk-quick-nav">
                                        <li class="dropdown user-dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                                                <div class="user-toggle">
                                                    <div class="user-avatar sm"><em class="icon ni ni-user-alt"></em></div>
                                                    <div class="user-info d-none d-xl-block">
                                                        <div class="user-name dropdown-indicator">{{ Auth::user()->name }}</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                    <div class="user-card">
                                                        <div class="user-avatar"><span>AB</span></div>
                                                        <div class="user-info"><span class="lead-text">{{ Auth::user()->name }}</span> <span class="sub-text">{{ Auth::user()->email }}</span></div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-inner">
                                                    <ul class="link-list">
                                                        {{--
                                                        <li>
                                                            <a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a>
                                                        </li>
                                                        --}}
                                                        <li>
                                                            <a class="dark-switch" href="javascript:void(0)"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a>
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
                                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
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
                                    @include('common.messages')
                                    <div class="nk-block">@yield('content')</div>
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
                                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Terms</a></li>
                                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Privacy</a></li>
                                    <li class="nav-item"><a class="nav-link" href="javascript:void(0)">Help</a></li>
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

        <!-- app-root  -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/js/bundle.js?ver=2.3.0') }}"></script>
        <script src="{{ asset('assets/js/scripts.js?ver=2.3.0') }}"></script>
        <script src="{{ asset('assets/js/charts/chart-ecommerce.js?ver=2.3.0') }}"></script>
        <script src="{{ asset('assets/js/custome.js') }}"></script>
        @yield('script')
    </body>
</html>
