@extends('layouts.app')

@section('content')
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

        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
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
                    <p class="card-text"><strong>Price:</strong> {{ $info['price'] }}</p>
                    <p class="card-text"><strong>Discount:</strong> {{ $info['discount'] }}</p>
                    <p class="card-text"><strong>Net Price:</strong> {{ $info['net_price'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .carousel-image {
        width: 100%;
        height: 200px; /* Adjust height as needed */
        object-fit: cover;
    }

    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .carousel {
        max-height: 200px; /* Ensure carousel height is consistent */
    }
</style>
@endsection
