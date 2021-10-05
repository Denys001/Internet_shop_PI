@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <form class="d-flex justify-content-center" method="GET" action="{{route('categories.create')}}">
        @csrf
        <button class="btn btn-success">
            Add a new category
        </button>
    </form>
    @if(count($categories) != 0)
    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Edite</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($categories as $category)
            <tr>
                <th scope="row" class="align-middle">
                    <img width="64px" height="64px" src="{{asset('/storage/' . $category->image)}}" alt="">
                </th>
                <td class="align-middle">{{$category->name}}</td>
                <td class="align-middle text-justify">{{$category->description}}</td>
                <td class="align-middle">
                    <form method="GET" action="{{ route('categories.edit', $category->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-success ">Edite</button>
                    </form>
                </td>
                <td class="align-middle">
                    <button class="btn btn-danger" onclick="$('{{'#modal' . $category->id }}').modal('show')">Delete</button>
                    <div class="modal" id="{{ 'modal' . $category->id }}" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-g text-info">
                                    <h5 class="modal-title">Attention</h5>
                                    <button type="button" class="close text-info" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you want to delete this category? </p>
                                </div>
                                <div class="modal-footer">
                                    <form  action="{{ route('categories.destroy', $category->id)}}" method="POST">
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
    @else
    <div class="jumbotron mt-3">
        <h1 class="w-100 text-center">Any of categories wasn't found</h1>
    </div>
    @endif
</div>

@endsection