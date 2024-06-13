@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Customer Details') }}</div>

                <div class="card-body">
                    <form  method="POST" action="{{ route('purchase.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus placeholder="Enter your name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" placeholder="Enter your email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>
                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Enter your mobile no.">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" placeholder="Enter your address">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pincode" class="col-md-4 col-form-label text-md-end">{{ __('Pincode') }}</label>
                            <div class="col-md-6">
                                <input id="pincode" type="text" class="form-control" name="pincode" placeholder="Enter your pincode">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="locality" class="col-md-4 col-form-label text-md-end">{{ __('Locality') }}</label>
                            <div class="col-md-6">
                                <input id="locality" type="text" class="form-control" name="locality" placeholder="Enter your locality">
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <label for="total_price" class="col-md-4 col-form-label text-md-end">{{ __('Total Price') }}</label>
                            <div class="col-md-6">
                                <input id="total_price" type="text" class="form-control" value="{{ $cart->total }}" name="total_price" >
                            </div>
                        </div> --}}
                        <div class="row mb-3">
                            <label for="total_price" class="col-md-4 col-form-label text-md-end">{{ __('Total Price') }}</label>
                            <div class="col-md-6">
                                <input id="total_price" type="text" class="form-control" name="total_price" value="{{ $cart->total }}" readonly>
                            </div>
                        </div>
                        
                        
                        <div class="d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-primary btn-block mt-2">Place Order</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
