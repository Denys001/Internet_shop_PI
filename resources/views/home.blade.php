@extends('layouts.app')

@section('content')
<div class="container mt-3 pl-0">
    @if ($errors->any())
    <div class="alert alert-danger pb-0">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container px-0 ">
        <form class="mb-3 " method="GET" action="{{route('main.index')}}">
            @csrf
            <div class="form-group row">
                <input class="form-control col-9 mr-3" value="{{ request()->text }}" require type="text" name="text" placeholder="Search by name" aria-label="Search">
                <button class="btn btn-success col-1 mr-2" type="submit">Search</button>
                <button class="btn btn-warning mr-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fas fa-filter"></i>
                </button>
                <button class="btn btn-secondary" type="button" onclick="event.preventDefault();
                                                     document.getElementById('Clear').submit();"><i class="fas fa-trash"></i></button>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="row">
                    <label class="text-primary font-weight-bold">Filter:</label>
                </div>
                <div class="form-group row">

                    <label class="mr-3 text-primary">Category:</label>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="all" name="category" value="All" class="custom-control-input" {{request()->has('category') && request()->category == 'All' ? 'checked' : ''}}>
                        <label class="custom-control-label" for="all">All</label>
                    </div>
                    @foreach($categories as $category)
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="{{$category->id}}" name="category" value="{{$category->id}}" {{request()->has('category') && request()->category == $category->id ? 'checked' : ''}} class="custom-control-input">
                        <label class="custom-control-label" for="{{$category->id}}">{{$category->name}}</label>
                    </div>
                    @endforeach
                </div>

                <div class="form-inline row mb-4">
                    <label class="mr-3 text-primary">Price:</label>
                    <label class="mr-3">From:</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror mr-3" step='0.01' min="0.00" max="99999.99" name="price_from" id="price_from" placeholder="Price" value="{{ request()->price_from }}">
                    <label class="mr-3">To:</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" step='0.01' min="0.00" max="99999.99" name="price_to" id="price_to" placeholder="Price" value="{{ request()->price_to }}">

                </div>
                <div class="form-group row">
                    <label class="text-primary font-weight-bold">Sorting:</label>
                    <div class="custom-control custom-radio ml-2 ">
                        <input type="radio" id="none" name="sortBy" {{request()->has('sortBy') && request()->sortBy == 'None' ? 'checked' : ''}} value="None" class="custom-control-input">
                        <label class="custom-control-label" for="none">None</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="likes" name="sortBy" {{request()->has('sortBy') && request()->sortBy == 'Likes' ? 'checked' : ''}} value="Likes" class="custom-control-input">
                        <label class="custom-control-label" for="likes">Likes</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="watches" name="sortBy" {{request()->has('sortBy') && request()->sortBy == 'Watches' ? 'checked' : ''}} value="Watches" class="custom-control-input">
                        <label class="custom-control-label" for="watches">Watches</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="orders" name="sortBy" {{request()->has('sortBy') && request()->sortBy == 'Orders' ? 'checked' : ''}} value="Orders" class="custom-control-input">
                        <label class="custom-control-label" for="orders">Orders</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="FromMin" name="sortBy" {{request()->has('sortBy') && request()->sortBy == 'FromMin' ? 'checked' : ''}} value="FromMin" class="custom-control-input">
                        <label class="custom-control-label" for="FromMin">From min price to max</label>
                    </div>
                    <div class="custom-control custom-radio ml-2">
                        <input type="radio" id="FromMax" name="sortBy" value="FromMax" {{request()->has('sortBy') && request()->sortBy == 'FromMax' ? 'checked' : ''}} class="custom-control-input">
                        <label class="custom-control-label" for="FromMax">From max price to min</label>
                    </div>
                </div>
                <div class="row d-fle justify-content-center">
                    <button class="btn btn-success col-2 mr-3" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <form method="GET" action="{{route('main.index')}}" style="display: none;" id="Clear">
            @csrf
        </form>
    </div>
    @if(count($products) != 0)
    <div class="row justify-content-around pl-0">
        @foreach($products as $product)
        @include('inds.Product')
        @endforeach
    </div>
    <div class="d-flex  justify-content-center">
        {{ $products->appends($_GET)->links() }}
    </div>
    @else
    <div class="jumbotron mt-3">
        <h1 class="w-100 text-center">There is currently empty</h1>
    </div>
    @endif
</div>
@endsection