@extends('layouts.app')

@section('content')
<form action="cart.index" method="post">
    <a href="{{route('cart.index')}}" class="btn btn-primary mb-3 mx-5"> Go to Cart </a>
</form>

<div class="container">
    <div class="row">
        @foreach ($data as $info)
        @php 
            $files=[];
            if(is_array($info)){
                foreach($info as $sinfo){
                    $files[]=$sinfo['file_path'];
                }
            }
        @endphp

        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
            <div class="card h-100">
                <div id="carouselExample{{ $loop->index }}" class="carousel slide">
                    <div class="carousel-inner">
                        @if(isset($info->media[0]->file_path))
                            @for($a = 0; $a < count($info->media); $a++)
                            <div class="carousel-item {{ $a == 0 ? 'active' : '' }}">
                                <img src="{{ asset('image/' . $info->media[$a]['file_path']) }}" class="d-block w-100 carousel-image" alt="Img">
                            </div>
                            @endfor
                        @else
                            <div class="carousel-item active">
                                <img src="{{ asset('image/imgnotavl.png') }}" class="d-block w-100 carousel-image" alt="Img">
                            </div>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample{{ $loop->index }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample{{ $loop->index }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $info['name'] }}</h5>
                    <p class="card-text">{{ $info['description'] }}</p>
                    <span class="card-text">₹ {{ $info['net_price'] }}</span>
                    <span class="card-text" style="color: grey">
                         <s>{{ $info['price'] }}</s>
                    </span>
                    <span class="card-text" style="color: green"> {{ $info['discount'] }}% Off</span>
                    
                    <!-- Add to Cart Button -->
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $info['id'] }}">
                        <button type="submit" class="btn btn-primary btn-block">Add to Cart</button>
                    </form>
                    
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .carousel-image {
        width: 100%;
        height: 200px; /* Fixed height for images */
        object-fit: contain; /* Ensure image is fully visible */
        background-color: white; /* Add white background to fill space */
        border: 1px solid white; /* Optional white border */
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 15px; /* Add border radius */
        overflow: hidden; /* Ensure rounded corners are visible */
    }

    .carousel {
        max-height: 200px; /* Ensure carousel height is consistent */
    }
</style>
@endsection
