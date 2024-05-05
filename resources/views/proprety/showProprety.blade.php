@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h2 class="mb-0">Property Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($property->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/images/' . $image->image_path) }}" class="d-block w-100" alt="Property Image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3 class="card-title">{{ $property->name }}</h3>
                    <p class="card-text"><strong>Address:</strong> {{ $property->address }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $property->price }}</p>
                    <p class="card-text"><strong>Size:</strong> {{ $property->size }} m²</p>
                    <p class="card-text"><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
                    <p class="card-text"><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
