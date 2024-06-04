@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Page') }}</div>

                <div class="card-body">
                    <form enctype="multipart/form-data" method="POST" action="{{ route('products.store') }}">
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
                                <input id="description" type="text" class="form-control" name="description" placeholder="Enter product description">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="col-md-4 col-form-label">{{ __('Product category name') }}</label>
                            <div class="col-md-6">
                                <select name="selected_values[]" id="category" class="form-control select2" multiple>
                                    @foreach($data as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                            <label for="GST" class="col-md-4 col-form-label text-md-end">{{ __('GST') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" list="gst" name="gstnumber" id="gstInput" placeholder="Enter GST rate" oninput="divideGST()">
                                <datalist id="gst">
                                    <option value="18">
                                    <option value="12">
                                    <option value="5">
                                </datalist>
                            </div>
                        </div>

                        <div id="cgst_sgst_section">
                            <div class="row mb-3">
                                <label for="cgst" class="col-md-4 col-form-label text-md-end">{{ __('CGST') }}</label>
                                <div class="col-md-6">
                                    <input id="cgst" type="number" class="form-control" name="cgst" min="0" max="100" placeholder="Enter CGST" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sgst" class="col-md-4 col-form-label text-md-end">{{ __('SGST') }}</label>
                                <div class="col-md-6">
                                    <input id="sgst" type="number" class="form-control" name="sgst" min="0" max="100" placeholder="Enter SGST" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="net_price" class="col-md-4 col-form-label text-md-end">{{ __('Net Price') }}</label>
                            <div class="col-md-6">
                                <input id="net_price" type="text" readonly class="form-control" name="net_price" min="0" placeholder="Net Price">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div>
                                {{-- <form action="/image-upload" > --}}
                                    {{-- @csrf --}}
                                    <input type="file" accept="image/*" multiple name="image[]">
                                {{-- </form> --}}
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block mt-2">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    function divideGST() {
        const gstValue = parseFloat(document.getElementById('gstInput').value) || 0;
        const halfGST = gstValue / 2;
        document.getElementById('cgst').value = halfGST;
        document.getElementById('sgst').value = halfGST;
        calculatePrice();
    }

    function calculatePrice() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const cgst = parseFloat(document.getElementById('cgst').value) || 0;
        const sgst = parseFloat(document.getElementById('sgst').value) || 0;

        const discountAmount = price * (discount / 100);
        const priceAfterDiscount = price - discountAmount;

        const gstAmount = priceAfterDiscount * (cgst / 100) + priceAfterDiscount * (sgst / 100);
        const netPrice = priceAfterDiscount + gstAmount;

        document.getElementById('net_price').value = netPrice.toFixed(2);
    }
</script>
@endsection
