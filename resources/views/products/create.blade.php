@extends('layouts.app')

@section('content')
{{-- @dd($data); --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Page') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Product name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="Enter product name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control " name="description"  placeholder = "Enter product description">

                            </div>
                        </div>
    <div class="mb-3">
        <label for="category" class="col-md-4 col-form-label">{{ __('Product category name') }}</label>
        <select name="selected_values[]" multiple>
            @foreach($data as $val)
                <option value="{{ $val->id }}">{{ $val->name }}</option>
            @endforeach
        </select>
</div>
                     

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control" name="price" min="0" placeholder="Enter Price" oninput="calculatePrice()">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('Discount') }}</label>
                            <div class="col-md-6">
                                <input id="discount" type="number" class="form-control" name="discount" min="0" max="100" placeholder="Enter discount" oninput="calculatePrice()">
                            </div>
                        </div>

     
                        <div class="row mb-3">
                            <label for="cgst" class="col-md-4 col-form-label text-md-end">{{ __('CGST') }}</label>

                            <div class="col-md-6">
                                <input id="cgst" type="number" class="form-control " name="cgst" min = 0 max = 100 placeholder = "Enter CGST">

                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="sgst" class="col-md-4 col-form-label text-md-end">{{ __('SGST') }}</label>

                            <div class="col-md-6">
                                <input id="sgst" type="number" class="form-control " name="sgst" min = 0 max = 100 placeholder = "Enter SGST">

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="net_price" class="col-md-4 col-form-label text-md-end">{{ __('Net Price') }}</label>
                            <div class="col-md-6">
                                <input id="net_price" type="hidden" readonly class="form-control" name="net_price" min="0" placeholder="Net Price" >
                            </div>
                        </div>


                        <!-- Other input fields... -->

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
<script>
    function calculatePrice() {
        var mrp = parseFloat(document.getElementById('Price').value);
        var discount = parseFloat(document.getElementById('discount').value);
        var cgst = parseFloat(document.getElementById('cgst').value);

        // Calculate the discounted price
        var discountedPrice = Price - (Price * (discount / 100));

        // Calculate the total price including CGST
        var totalPrice = discountedPrice + (discountedPrice * (cgst / 100));

        // Set the calculated price in the price input field
        document.getElementById('Net Price').value = NetPrice.toFixed(2);
    }
</script>

</script>
@endsection
