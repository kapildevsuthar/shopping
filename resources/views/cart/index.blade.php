@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <h4>Shopping Cart</h4>
            @if (session('cart'))
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart') as $id => $details)
                            @php
                                $imagePath = file_exists(public_path('image/' . $details['image'])) ? asset('image/' . $details['image']) : asset('image/imgnotavl.png');
                            @endphp
                            <tr data-id="{{ $id }}">
                                <td>
                                    <img src="{{ $imagePath }}" width="50" height="50" class="img-responsive"/>
                                </td>
                                <td>{{ $details['name'] }}</td>
                                <td class="price">₹{{ $details['net_price'] }}</td>
                                <td>
                                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" min="1" data-price="{{ $details['net_price'] }}"/>
                                </td>
                                <td class="subtotal">₹{{ $details['net_price'] * $details['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="remove-cart-form">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="id" value="{{ $id }}">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Your cart is empty</p>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Cart Summary</h5>
                    <p class="card-text">Total: ₹<span id="cart-total">{{ array_sum(array_map(function($details)
                     { return $details['net_price'] * $details['quantity']; }, session('cart') ?? [])) }}</span></p>
                    <a href="purchase/create" class="btn btn-primary">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.querySelectorAll('.quantity').forEach(function(input) {
    input.addEventListener('input', function() {
        const price = parseFloat(input.dataset.price);
        const quantity = parseInt(input.value);
        const subtotalCell = input.closest('tr').querySelector('.subtotal');
        const newSubtotal = price * quantity;

        subtotalCell.textContent = '₹' + newSubtotal.toFixed(2);
        
        updateCartTotal();
    });
});

function updateCartTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal').forEach(function(subtotalCell) {
        total += parseFloat(subtotalCell.textContent.replace('₹', ''));
    });
    document.getElementById('cart-total').textContent = total.toFixed(2);
}

document.querySelectorAll('.quantity').forEach(function(input) {
    input.addEventListener('input', function() {
        const id = input.closest('tr').dataset.id;
        const quantity = input.value;

        $.ajax({
            url: '{{ route("cart.update") }}',
            method: 'patch',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function(response) {
                input.closest('tr').querySelector('.subtotal').textContent = '₹' + response.subtotal.toFixed(2);
                document.getElementById('cart-total').textContent = response.total.toFixed(2);
            }
        });
    });
});
</script>
@endsection
