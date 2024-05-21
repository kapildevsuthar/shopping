@extends('layouts.app')

@section('content')
<div class="container">
    @if(Session::get('success'))
    <div class="alert alert-success text-center">
        {{ Session::get('success') }}
    </div>
    @endif

    <div class="mb-3">
           <form action="{{ route('products.destroy', $products->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
            <a href="{{ route('product.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
        <table class="table table-striped border">
            <thead class="table-primary">
                <tr>
                    <th>S.no.</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>CGST</th>
                    <th>SGST</th>
                    <th>NetPrice</th>
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
                    <td>{{ $info['price'] }}</td>
                    <td>{{ $info['discount'] }}</td>
                    <td>{{ $info['cgst'] }}</td>
                    <td>{{ $info['sgst'] }}</td>
                    <td>{{ $info['net_price'] }}</td>
                    <td><a href="/products/{{ $info["id"] }}/edit">Edit</a></td>
                    <td><input type="checkbox" name="product_ids[]" value="{{ $info['id'] }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('deleteButton').onclick = function () {
        var checkboxes = document.querySelectorAll('input[name="product_ids[]"]:checked');
        if (checkboxes.length > 0) {
            var confirmationMessage = checkboxes.length === 1 ?
                'Are you sure you want to delete the selected product?' :
                'Are you sure you want to delete the selected products?';
                

            var confirmation = confirm(confirmationMessage);
            if (confirmation) {
                document.getElementById('deleteForm').submit();
            }
        } else {
            alert('Please select at least one product to delete.');
        }
    };
</script>
@endsection
