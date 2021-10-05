@extends('layouts.app')
@section('content')
<div class="container-fluid mt-3">
    <form method="POST" action="{{route('main.order.storeAll')}}">
        @csrf
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Sum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($baskets as $product)
                <tr>
                    <th scope="row" class="d-flex justify-content-center">
                        <img height="64px" src="{{asset('/storage/' . $product->Product()->image)}}" alt="">
                    </th>
                    <td class="align-middle">{{$product->Product()->name}}</td>
                    <td class="align-middle text-justify">{{Str::limit($product->Product()->description, 100)}}</td>
                    <td class="align-middle text-justify">{{$product->Product()->category->name}}</td>
                    <td class="align-middle text-justify">{{$product->Product()->price}}$</td>
                    <td class="align-middle text-justify">
                        <div class="w-100">
                            <input name="{{'amount' . $product->id}}" id="{{'amount' . $product->id}}" onchange="document.getElementById('{{'sum' . $product->id}}').innerHTML = (document.getElementById('{{'amount' . $product->id}}').value*{{$product->Product()->price}}).toFixed(2)+'$' " type="number" value="1" min="1" max="25" step="1" class="form-control">
                        </div>
                    </td>
                    <td class="align-middle text-justify">
                        <div class="" name="{{'sum' . $product->id}}" id="{{'sum' . $product->id}}">{{$product->Product()->price}}$</div>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

        <div class="container d-flex justify-content-center">

            <div class="row w-25">
                <div class="w-100">
                    <div class="form-group w-100">
                        <label for="phone" class="control-label text-center w-100 mr-2">Phone number: </label>
                        <div class="w-100">
                            <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{3}" placeholder="XXX-XX-XX-XXX" name="phone" id="phone" required value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group w-100">
                        <label for="name" class="control-label text-center w-100 mr-2">Address: </label>
                        <div class="w-100">
                            <input type="text" name="address" id="address" required value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group w-100 d-flex justify-content-center">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>

                </div>
            </div>



        </div>
    </form>
</div>
@endsection