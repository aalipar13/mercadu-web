<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap Date Picker -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css" rel="stylesheet">

    <!-- Admin Custom CSS -->
    <link href="{{ mix('/css/admin/custom.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top no-margin-bottom">
            <div class="container-fluid">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/admin/home') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('admin.login') }}">Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ empty(Auth::user()->userDetail->first_name) ? 'Admin' : Auth::user()->userDetail->first_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('admin.logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    
        @if (Auth::check())
            <div class="row">
                <div class="container-fluid flex-center">
                    
                        <!-- Sidebar -->
                        <div id="sidebar-wrapper">
                            <ul class="sidebar-nav">
                                <li class="{{ (Request::is('admin/store/*')) || (Request::is('admin/store-photo/*')) ? 'active' : '' }}"><a href="{{ route('admin.store.index') . '?records=10' }}">Store</a></li>
                                <li class="{{ (Request::is('admin/tag/*')) ? 'active' : '' }}"><a href="{{ route('admin.tag.index') . '?records=10' }}">Tag</a></li>
                                <li class="{{ (Request::is('admin/category/*')) ? 'active' : '' }}"><a href="{{ route('admin.category.index') . '?records=10' }}">Category</a></li>
                                <li class="{{ (Request::is('admin/product/*')) ? 'active' : '' }}"><a href="{{ route('admin.product.index') . '?records=10' }}">Product</a></li>
                                <li class="{{ (Request::is('admin/tag-mapping/*')) ? 'active' : '' }}"><a href="{{ route('admin.tag-mapping.index') }}">Tag Mapping</a></li>
                            </ul>
                        </div>
                        <!-- /#sidebar-wrapper -->
                    
                </div>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="{{ mix('/js/admin/custom.js') }}"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>