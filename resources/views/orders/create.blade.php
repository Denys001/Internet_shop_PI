@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row" class="d-flex justify-content-center">
                    <img height="64px" src="{{asset('/storage/' . $product->image)}}" alt="">
                </th>
                <td class="align-middle">{{$product->name}}</td>
                <td class="align-middle text-justify">{{Str::limit($product->description, 100)}}</td>
                <td class="align-middle text-justify">{{$product->category->name}}</td>
                <td class="align-middle text-justify">{{$product->price}}$</td>
            </tr>
        </tbody>
    </table>

    <div class="container d-flex justify-content-center">
        <form class="row w-25" method="POST" action="{{route('main.order.store', $product->id)}}">
            @csrf
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
                <div class="form-group w-100">
                    <label for="name" class="control-label text-center w-100 mr-2">Amount: </label>
                    <div class="w-100">
                        <input onchange="document.getElementById('total').innerHTML = (document.getElementById('amount').value*{{$product->price}}).toFixed(2)+'$' " type="number" name="amount" id="amount" value="1" min="1" max="25" step="1" class="form-control">
                    </div>
                </div>
                <div class="form-group w-100">
                    <label for="name" class="control-label text-primary text-center w-50 ">Total: </label>
                    <label for="name" id="total" class="control-label text-primary text-center w-25 ">{{$product->price}}$ </label>
                </div>
                <div class="form-group w-100 d-flex justify-content-center">
                    <input type="submit" class="btn btn-success" value="Submit">
                </div>

            </div>
        </form>
    </div>
</div>
@endsection