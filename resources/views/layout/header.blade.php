<header>
	<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/icon/pokemon.png') }}" width="20px" style="display: inline-block;margin-bottom: 4px;">
                    PokeMart
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    @if (Auth::hasRole('member'))
                    <li><a href="{{ url('/pokemon') }}">Pokemon</a></li>
                    <li><a href="{{ url('/transaction') }}">Transaction</a></li>
                    @elseif (Auth::hasRole('admin'))
                    <li class="dropdown">
                        <a style="cursor: pointer;">Pokemon</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admin/pokemon/insert') }}">Insert</a></li>
                            <li><a href="{{ url('/admin/pokemon?action=update') }}">Update</a></li>
                            <li><a href="{{ url('/admin/pokemon?action=delete') }}">Delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a style="cursor: pointer;">Element</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admin/element') }}">Insert</a></li>
                            <li><a href="{{ url('/admin/element/update') }}">Update</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a style="cursor: pointer;">User</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admin/user?action=update') }}">Update</a></li>
                            <li><a href="{{ url('/admin/user?action=delete') }}">Delete</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a style="cursor: pointer;">Transaction</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/admin/transaction?action=update') }}">Update</a></li>
                            <li><a href="{{ url('/admin/transaction?action=delete') }}">Delete</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Hi, {{ Auth::user()->email }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if (Auth::hasRole('member'))
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
                                <li><a href="{{ url('/cart') }}"><i class="fa fa-btn fa-sign-out"></i>Cart</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>