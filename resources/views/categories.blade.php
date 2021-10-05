@extends('layouts.app')
@section('content')
<div class="container mt-3">
    @foreach($categories as $category)
    <div class="panel  d-flex flex-column justify-content-center align-items-center">
        <img width="64px" height="64px" src="{{asset('/storage/' . $category->image)}}">
        <a href="{{route('main.category', $category->name)}}">
            <h2>{{$category->name}}</h2>
        </a>
        <p class="text-justify">
            {{$category->description}}
        </p>
    </div>
    @endforeach
</div>
@endsection