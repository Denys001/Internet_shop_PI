@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <div class="container">
        <form class="form-group row " method="POST" action="{{route('products.search.archive')}}">
            @csrf
            <input class="form-control col-9 mr-5" value="{{ isset($text) ? $text : ''}}" require type="text" name="text" placeholder="Search by name" aria-label="Search">
            <button class="btn btn-success col-2" type="submit">Search</button>
        </form>
    </div>
    @if(count($Products) != 0)
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Show</th>
                <th scope="col">Unarchive</th>
                <th scope="col">Delete</th>
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
                <td class="align-middle text-justify">
                    <form method="GET" action="{{ route('products.show', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-success ">Show</button>
                    </form>
                </td>
                <td class="align-middle">
                    <form method="GET" action="{{ route('products.unarchive-process', $product->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-warning ">Unachive</button>
                    </form>
                </td>
                <td class="align-middle">
                    <button class="btn btn-danger" onclick="$('{{'#modal' . $product->id }}').modal('show')">Delete</button>
                    <div class="modal" id="{{ 'modal' . $product->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-g text-info">
                                    <h5 class="modal-title">Attention</h5>
                                    <button type="button" class="close text-info" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this product? </p>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('products.destroy', $product->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-success ">Yes</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </div>
                    </div>
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