<nav class="navbar navbar-expand-md navbar-light bg-g text-info shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand text-info" href="{{ url('/') }}">
            {{ config('app.name', 'Shp') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            @auth
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('main.index') ? 'active' : ''}}" href="{{ route('main.index') }}">All products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('main.categories') ? 'active' : ''}}" href="{{ route('main.categories') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('baskets.index') ? 'active' : ''}}" href="{{ route('baskets.index') }}"><i class="fas fa-shopping-cart fa-lg mr-2"></i>Basket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('main.order.index') ? 'active' : ''}}" href="{{ route('main.order.index') }}">My orders</a>
                </li>
            </ul>
            @endauth
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link text-info {{ Request::RouteIs('login') ? 'active' : ''}}" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link text-info {{ Request::RouteIs('register') ? 'active' : ''}}" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-info" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(!Auth::user()->isAdmin)
                        <a class="dropdown-item" href="{{ route('GettingAdmin') }}" onclick="event.preventDefault();
                                                     document.getElementById('getAdmin').submit();">
                            Get admin
                        </a>
                        @else
                        <a class="dropdown-item" href="{{ route('categories.index') }}" onclick="event.preventDefault();
                                                     document.getElementById('AdminPanel').submit();">
                            Admin panel
                        </a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <form id="getAdmin" action="{{ route('GettingAdmin') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                        <form id="AdminPanel" action="{{ route('categories.index') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>