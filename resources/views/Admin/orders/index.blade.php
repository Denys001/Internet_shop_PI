@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Waiting for processing({{$waitings->count()}})
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    @if(count($waitings) != 0)
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
                                    <th scope="col">Process</th>
                                    <th scope="col">Cancel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($waitings as $waiting)
                                <tr>
                                    <th scope="row" class="d-flex justify-content-center">
                                        <img height="64px" src="{{asset('/storage/' . $waiting->product()->image)}}" alt="">
                                    </th>
                                    <td class="align-middle">{{$waiting->product()->name}}</td>
                                    <td class="align-middle text-justify">{{$waiting->product()->price}}$</td>
                                    <td class="align-middle text-justify">{{$waiting->amount}}</td>
                                    <td class="align-middle text-justify">{{$waiting->amount*$waiting->product()->price}}$</td>
                                    <td class="align-middle text-justify">{{\Carbon\Carbon::parse($waiting->created_at)->format('d/m/Y') }}</td>
                                    <td class="align-middle text-justify">{{$waiting->address}}</td>
                                    <td class="align-middle text-justify">{{$waiting->phone_number}}</td>
                                    <td class="align-middle text-justify">
                                        <form method="GET" action="{{route('orders.process', $waiting->id)}}">
                                            <button type="submit" class="btn btn-primary">Process</button>
                                        </form>
                                    </td>
                                    <td class="align-middle text-justify">
                                        <form method="POST" action="{{route('orders.destroy', $waiting->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary">Cancel</button>
                                        </form>
                                    </td>
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
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        In processing({{$processings->count()}})
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    @if(count($processings) != 0)
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
                                    <th scope="col">Done</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($processings as $processing)
                                <tr>
                                    <th scope="row" class="d-flex justify-content-center">
                                        <img height="64px" src="{{asset('/storage/' . $processing->product()->image)}}" alt="">
                                    </th>
                                    <td class="align-middle">{{$processing->product()->name}}</td>
                                    <td class="align-middle text-justify">{{$processing->product()->price}}$</td>
                                    <td class="align-middle text-justify">{{$processing->amount}}</td>
                                    <td class="align-middle text-justify">{{$processing->amount*$processing->product()->price}}$</td>
                                    <td class="align-middle text-justify">{{$processing->created_at}}</td>
                                    <td class="align-middle text-justify">{{$processing->address}}</td>
                                    <td class="align-middle text-justify">{{$processing->phone_number}}</td>
                                    <td class="align-middle text-justify">
                                        <form method="GET" action="{{route('orders.done', $processing->id)}}">
                                            <button type="submit" class="btn btn-primary">Done</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row justify-content-around">
                        </div>
                        @else
                        <div class="">
                            <h1 class="w-100 text-center">It is currently empty</h1>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection