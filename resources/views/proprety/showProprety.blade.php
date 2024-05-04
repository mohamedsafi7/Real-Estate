@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card  mt-4">
        <div class="card-header">
            <h2 class="mb-0">Property Details</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('storage/images/' . $property->images->first()->image_path) }}" class="img-fluid" alt="Property Image">
                </div>
                <div class="col-md-6">
                    <h3 class="card-title">{{ $property->name }}</h3>
                    <p class="card-text"><strong>Address:</strong> {{ $property->address }}</p>
                    <p class="card-text"><strong>Price:</strong> ${{ $property->price }}</p>
                    <p class="card-text"><strong>Size:</strong> {{ $property->size }} m²</p>
                    <p class="card-text"><strong>Bedrooms:</strong> {{ $property->bedrooms }}</p>
                    <p class="card-text"><strong>Bathrooms:</strong> {{ $property->bathrooms }}</p>
                    <!-- Add more property details as needed -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
