@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Upload Media for {{ $product->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('product_media.store', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="media">Choose Media Files</label>
            <input type="file" name="media[]" id="media" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
