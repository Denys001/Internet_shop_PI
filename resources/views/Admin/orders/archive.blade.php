@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <div class="container">
        <form class="form-group row " method="GET" action="{{route('orders.archive')}}">
            @csrf
            <input class="form-control col-9 mr-5" value="{{request()->has('text') ? request()->text : '' }}" require type="text" name="text" placeholder="Search by name" aria-label="Search">
            <button class="btn btn-success col-1 mr-3" type="submit">Search</button>
            <button class="btn btn-secondary" type="button" onclick="event.preventDefault();
                                                     document.getElementById('Clear').submit();"><i class="fas fa-trash"></i></button>
        </form>
        <form method="GET" action="{{route('orders.archive')}}" style="display: none;" id="Clear">
            @csrf
        </form>
    </div>
    @if(count($dones) != 0)
    <div class="container-fluid mt-3">
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Total</th>
                    <th scope="col">Order data</th>
                    <th scope="col">Adress</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">User</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dones as $done)
                <tr>
                    <th scope="row" class="d-flex justify-content-center">
                        <img height="64px" src="{{asset('/storage/' . $done->product()->image)}}" alt="">
                    </th>
                    <td class="align-middle">{{$done->product()->name}}</td>
                    <td class="align-middle text-justify">{{$done->product()->price}}$</td>
                    <td class="align-middle text-center">{{$done->amount}}</td>
                    <td class="align-middle text-justify">{{$done->amount*$done->product()->price}}$</td>
                    <td class="align-middle text-justify">{{\Carbon\Carbon::parse($done->created_at)->format('d/m/Y') }}</td>
                    <td class="align-middle text-justify">{{$done->address}}</td>
                    <td class="align-middle text-justify">{{$done->phone_number}}</td>
                    <td class="align-middle text-justify">{{$done->user()->name}}</td>
                    <td class="align-middle text-justify">{{$done->user()->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="">
        <h1 class="w-100 text-center">It is currently empty</h1>
    </div>
    @endif
</div>

@endsection