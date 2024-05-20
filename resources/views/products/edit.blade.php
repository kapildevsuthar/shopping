@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Product Page') }}</div>
{{-- {{dd($product)}} --}}
                
                <div class="card-body">
                    <form method="POST" action="/products/{{$product['id']}}">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Product name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control " name="name" required value = {{$product['name']}} autofocus placeholder = "Enter product name">

                            </div>
                        </div>
                       

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('description') }}</label>
                            <div class="col-md-6">
                                {{-- <input id="description" type="text" class="form-control " name="description"  value =  placeholder = "Enter product description"> --}}
                                <textarea id="description"  class="form-control " name="description"   >{{$product['description']}}</textarea>
                            </div>
                        </div>
                        @php
                         $scats=[];
                         foreach($product->categoryids as $pcinfo){
                            $scats[]=$pcinfo->category_id;
                         }  
                         @endphp
                        <div class="mb-3">
                            <label for="category" class="col-md-4 col-form-label">{{ __('Product category name') }}</label>
                    <select multiple>
                            @foreach($data as $val){
                    <option value="{{$val->id}}" {{(in_array($val->id,$scats))?"selected":""}}>{{$val->name}}</option>
                    
                            }
                            @endforeach
                    </select>
                    </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control " name="price"  value = {{$product['price']}} min= 0  placeholder = "Enter price">

                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="discount" class="col-md-4 col-form-label text-md-end">{{ __('discount') }}</label>

                            <div class="col-md-6">
                                <input id="discount" type="number" class="form-control " name="discount"  value = {{$product['discount']}} min = 0 max = 100 placeholder = "Enter discount">

                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <label for="GST" class="col-md-4 col-form-label text-md-end">{{ __('GST') }}</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" list="gst" name="gstnumber" id="gstInput" value="{{$product['GST']}}" oninput="divideGST()" placeholder="Select GST rate">
                                <datalist id="gst">
                                    <option value="18"></option>
                                    <option value="12"></option>
                                    <option value="5"></option>
                                </datalist>
                            </div>
                        </div>

                        <div id="cgst_sgst_section">
                            <div class="row mb-3">
                                <label for="cgst" class="col-md-4 col-form-label text-md-end">{{ __('CGST') }}</label>
                                <div class="col-md-6">
                                    <input id="cgst" type="number" class="form-control" name="cgst" min="0" max="100" placeholder="Enter CGST" value = {{$product['cgst']}} readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="sgst" class="col-md-4 col-form-label text-md-end">{{ __('SGST') }}</label>
                                <div class="col-md-6">
                                    <input id="sgst" type="number" class="form-control" name="sgst" min="0" max="100" placeholder="Enter SGST" value = {{$product['sgst']}} readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="net_price" class="col-md-4 col-form-label text-md-end">{{ __('Net Price') }}</label>
                            <div class="col-md-6">
                                <input id="net_price" type="text" readonly class="form-control" name="net_price" min="0" placeholder="Net Price" value = {{$product['net_price']}}>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>

                              
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function divideGST() {
        const gstValue = parseFloat(document.getElementById('gstInput').value) || 0;
        const halfGST = gstValue / 2;
        document.getElementById('cgst').value = halfGST;
        document.getElementById('sgst').value = halfGST;
    }
    
    function calculatePrice() {
        const price = parseFloat(document.getElementById('price').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const gstType = document.querySelector('input[name="gst_type"]:checked') ? document.querySelector('input[name="gst_type"]:checked').value : 'cgst_sgst';
        let cgst = 0, sgst = 0, igst = 0;
    
        if (gstType === 'cgst_sgst') {
            cgst = parseFloat(document.getElementById('cgst').value) || 0;
            sgst = parseFloat(document.getElementById('sgst').value) || 0;
        } else {
            igst = parseFloat(document.getElementById('igst').value) || 0;
        }
    
        const discountAmount = price * (discount / 100);
        const priceAfterDiscount = price - discountAmount;
    
        let gstAmount = 0;
        if (gstType === 'cgst_sgst') {
            gstAmount = priceAfterDiscount * (cgst / 100) + priceAfterDiscount * (sgst / 100);
        } else {
            gstAmount = priceAfterDiscount * (igst / 100);
        }
    
        const netPrice = priceAfterDiscount + gstAmount;
        document.getElementById('net_price').value = netPrice.toFixed(2);
    }
    </script>
@endsection
