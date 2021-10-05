@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="name " class="text-success">Category name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') ? old('name') : $category->name }}" require placeholder="Enter category name">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="text" class="text-success">Description:</label>
            <textarea type="password" class="form-control @error('text') is-invalid @enderror" name="text" id="text" placeholder="Description">{{ old('text') ? old('text') : $category->description  }}</textarea>
            @error('text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="text" class=" col-form-label text-md-right text-success">Image:</label>
            <div class="">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image" accept="image/*" value="{{ old('image') }}" onchange="$('#upload-file-info').val($(this).val());" id="image">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                </div>
                <input type="text" class="form-control border-0 bg-white mx-auto font-weight-bold text-success" require value="{{ old('image') }}" id="upload-file-info" readonly>
                
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-success col-2">Submit</button>
        </div>
    </form>
</div>
@endsection