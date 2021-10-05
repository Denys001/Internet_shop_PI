@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <div class="container">
        <form class="form-group row " method="POST" action="{{route('products.search')}}">
            @csrf
            <input class="form-control col-9 mr-5" value="{{ isset($text) ? $text : ''}}" require type="text" name="text" placeholder="Search by name" aria-label="Search">
            <button class="btn btn-success col-2" type="submit">Search</button>
        </form>
    </div>
    <form class="d-flex justify-content-center" method="GET" action="{{route('products.create')}}">
        @csrf
        <button class="btn btn-success">
            Add a new product
        </button>
    </form>
    @if(count($Products) != 0)
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Show</th>
                <th scope="col">Edite</th>
                <th scope="col">Archive</th>
            </tr>
        </thead>
        <tbody>

            @foreach($Products as $product)
            <tr>
                <th scope="row" class="d-flex justify-content-center">
                    <img height="64px" src="{{asset('/storage/' . $product->image)}}" alt="">
                </th>
                <td class="align-middle">{{$product->name}}</td>
                <td class="align-middle text-justify">{{Str::limit($product->description, 100)}}</td>
                <td class="align-middle text-justify">{{$product->category->name}}</td>
                <td class="align-middle text-justify">{{$product->price}}$</td>
                <td class="align-middle text-justify">
                    <form method="GET" action="{{ route('products.show', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-success ">Show</button>
                    </form>
                </td>
                <td class="align-middle">
                    <form method="GET" action="{{ route('products.edit', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-warning ">Edite</button>
                    </form>
                </td>
                <td class="align-middle">
                    <form method="GET" action="{{ route('products.archive-process', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-secondary ">Archive</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex  justify-content-center">
        {{ $Products->links() }}
    </div>
    @else
    <div class="jumbotron mt-3">
        <h1 class="w-100 text-center">Any of product wasn't found</h1>
    </div>
    @endif
</div>

@endsection