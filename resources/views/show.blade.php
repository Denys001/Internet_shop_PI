@extends('layouts.app')
@section('content')
<div class="container-fluid mt-3">
    @if($product)
    <div class="wrapper-Products">
        <div class="Products-image w-100 d-flex justify-content-center align-items-center">
            <img class="w-75" src="{{$product->image ? asset('/storage/' . $product->image) : ''}}">
        </div>
        <div class="Products-content">
            <h1 class="w-100 text-center">{{$product->name}}</h1>
            @if($product->Archive)
            <p class="w-100 text-center mb-2 text-primary"><strong>In the archive</strong></p>
            @endif
            <h3 class="mb-0">
                <p class="text-dark text-center w-100">{{$product->price}}$</p>
            </h3>
            <h3 class="mb-0 d-flex justify-content-around">
                <form action="{{route('product_like', $product->id)}}" method="GET">
                    <button class="btn {{ $product->liked ? 'btn-primary' : 'btn-outline-primary' }}"><i class="far fa-thumbs-up"> {{$product->likesCount}}</i></button>
                </form>
                <form action="{{route('product_dislike', $product->id)}}" method="GET">
                    <button class="btn {{ $product->disliked ? 'btn-danger' : 'btn-outline-danger' }}"><i class="far fa-thumbs-down"> {{$product->DislikesCount}}</i></button>
                </form>
                <p class="text-primary"><i class="far fa-eye"> {{$product->watched}}</i> </p>
                <p class="text-primary">Orders: {{$product->amount_orders}}</p>
            </h3>
            <div class="jumbotron py-3">
                <p class="mb-0 text-justify">
                    {{$product->description}}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-center w-100">
                <form action="{{route('main.order.create', $product)}}" method="GET">
                    <button type="submit" class="btn btn-primary mr-5">Buy</button>
                </form>
                <form action="{{route('baskets.add', $product->id)}}">
                    <button type="submit" class="btn btn-outline-primary"><i class="fas fa-shopping-cart"></i></button>
                </form>
            </div>
        </div>
        <div class="Products-coments mt-5">
            @comments(['model' => $product])
        </div>
    </div>
    @else
    <div class="jumbotron">
        <h1 class="text-center w-100">The product didn't find</h1>
    </div>
    @endif
</div>
@endsection