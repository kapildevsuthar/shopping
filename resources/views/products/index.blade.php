@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::get('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="mb-3">
        <form action="{{ url('/delete-all') }}" method="POST">
            @csrf
            <a href="/products/create" class="btn btn-success">Add</a>
            <button type="submit" class="btn btn-danger float-end">Delete All</button>
        </form>
        <table class="table table-striped border">
            <thead class="table-primary">
                <tr>
                    <th>S.no.</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>MRP</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $info)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $info['name'] }}</td>
                    <td>{{ $info['description'] }}</td>
                    <td>{{ $info['mrp'] }}</td>
                    <td>{{ $info['price'] }}</td>
                    <td>{{ $info['discount'] }}</td>
                    <td>{{ $info['cgst'] }}</td>
                    <td>{{ $info['sgst'] }}</td>
                    <td><a href="/products/{{ $info["id"] }}/edit">Edit</a></td>
                    <td><a href="/products/{{ $info["id"] }}/destroy">Destroy</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
