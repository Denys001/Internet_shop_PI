@extends('layouts.app')
@section('content')
@if(count($baskets) != 0)
<div class="container mt-3">
    <div class="d-flex justify-content-center">
        <form action="{{route('main.order.all')}}">
            <button type="submit" class="btn btn-primary mb-3">Buy all</button>
        </form>
    </div>
    <div class="row justify-content-around">
        @foreach($baskets as $basket)
        <div class="d-none">
            {{$product = $basket->Product()}}
        </div>
        @include('basket.inds.product')
        @endforeach
    </div>
    <div class="d-flex  justify-content-center">
        {{ $baskets->links() }}
    </div>
</div>
@else
<div class="jumbotron mt-3">
    <h1 class="w-100 text-center">Your basket is currently empty</h1>
</div>
@endif
@endsection