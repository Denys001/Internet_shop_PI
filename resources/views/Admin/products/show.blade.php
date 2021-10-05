@extends('layouts.admin')
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
                <p class="text-dark"><i class="far fa-thumbs-up"> {{$product->likesCount}}</i></p>
                <p class="text-dark"><i class="far fa-thumbs-down"> {{$product->DislikesCount}}</i></p>
                <p class="text-dark"><i class="far fa-eye"> {{$product->watched}}</i> </p>
                <p class="text-dark">Orders: {{$product->amount_orders}}</p>
            </h3>
            <div class="jumbotron py-3">
                <p class="mb-0 text-justify">
                    {{$product->description}}
                </p>
            </div>

        </div>
        <div class="Products-coments mt-5">
            @comments(['model' => $product])
        </div>
    </div>
    @else
    <div class="jumbotron">
        <h1 class="text-center w-100">The post didn't find</h1>
    </div>
    @endif
</div>
@endsection