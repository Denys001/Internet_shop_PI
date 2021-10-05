@extends('layouts.app')
@section('content')
<div class="jumbotron">
    <!-- d-flex justify-content-center -->
    <div class="container">
        <h1 class="jumbotron-heading">Admin rights</h1>
        <p class="lead text-muted">In order to get admin rights you need to enter a secret key.</p>
        <form method="POST" action="{{Route('GettingAdmin-processing')}}">
            @csrf
            <div class="form-group">
                <label for="keyword">Secret key</label>
                <input type="password" class="form-control @error('keyword') is-invalid @enderror" name="keyword" id="keyword" placeholder="Enter key" autofocus value="{{ old('keyword') }}" required>
                @error('keyword')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection