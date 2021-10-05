<nav class="navbar navbar-expand-md navbar-light bg-g text-info shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand text-info" href="{{ url('#') }}">
            Admin panel
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('categories.index') ||
                     Request::RouteIs('categories.store') || 
                     Request::RouteIs('categories.create') ||
                     Request::RouteIs('categories.destroy') || 
                     Request::RouteIs('categories.update') || 
                     Request::RouteIs('categories.show') || 
                     Request::RouteIs('categories.edit')   
                     ? 'active' : ''}}" href="{{ route('categories.index') }}">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ 
                     Request::RouteIs('products.index') ||
                     Request::RouteIs('products.store') || 
                     Request::RouteIs('products.create') ||
                     Request::RouteIs('products.destroy') || 
                     Request::RouteIs('products.update') || 
                     Request::RouteIs('products.show') || 
                     Request::RouteIs('products.edit')   
                     ? 'active' : ''}}" href="{{ route('products.index') }}">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ Request::RouteIs('products.archive') ? 'active' : ''}}" href="{{ route('products.archive') }}">Archive of products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ Request::RouteIs('orders.index') ? 'active' : ''}}" href="{{ route('orders.index') }}">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info 
                    {{ Request::RouteIs('orders.archive') ? 'active' : ''}}" href="{{ route('orders.archive') }}">Archive orders</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <form method="GET" action="{{ route('main.index') }}">
                        <button class="btn btn-success">
                            Back to shop
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>