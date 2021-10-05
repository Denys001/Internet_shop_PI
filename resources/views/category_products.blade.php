@extends('layouts.app')
@section('content')
<div class="container mt-3">
    @if($products)
    <div class="panel  d-flex flex-column justify-content-center align-items-center">
        <img width="64px" height="64px" src="{{asset('/storage/' . $category->image)}}">
        <a class="text-primary">
            <h2>{{$category->name}}</h2>
        </a>
        <p class="text-justify">
            Products was found {{$category->products->count()}} in this category
        </p>
    </div>
    <div class="row justify-content-around">
        @foreach($products as $product)
        @include('inds.Product')
        @endforeach
    </div>
    <div class="d-flex  justify-content-center">
        {{ $products->links() }}
    </div>
    @else
    <div class="jumbotron">
        <h1 class="text-center w-100">Products wasn't found in this category</h1>
    </div>
    @endif
</div>
@endsection