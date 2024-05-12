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
                    <h4 class="card-title"><strong>Category:</strong> <span style="text-transform: uppercase;">{{ $property->category->name }}</span></h4>

                    <div id="propertyCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($property->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/images/' . $image->image_path) }}" class="d-block w-100" alt="Property Image">
                                    @if ($property->listingType->name == 'sell')
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                    @else
                                        <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                    @endif
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
                    <div class="col-md-6 offset-md-6"> 
                        <div class="text-center mb-4">
                                {{-- <img src="{{ asset('storage/users/' . $property->owner->image) }}" class="rounded-circle" alt="Owner Image" style="width: 150px;"> --}}
                                <img class="img-fluid"  style="width: 310px; height:250px; " src="{{ asset('storage/users/' . $property->owner->image) }}" alt="{{  $property->owner->name }}">

                                <h4 class="mt-2"><strong>Owner :</strong> {{ $property->owner->name }}</h4>
                                <p><i class="fa fa-envelope text-primary me-2"></i> {{ $property->owner->email }}</p>
                                <p><i class="fa fa-phone text-primary me-2"></i> {{ $property->owner->phone }}</p>
                          
                        </div>
                    </div>
                    <p class="card-text"><strong>city :</strong> <i class="fa fa-map-marker-alt text-primary me-2"></i>  {{ $property->city }}</p>
                    <p class="card-text"><strong>adress :</strong> <i class="fa fa-map-marker-alt text-primary me-2"></i> {{ $property->address }}</p>
                    <p class="card-text"><strong>price :</strong> <i class="fa fa-money-bill-alt text-primary me-2"></i>  {{ $property->price }}DH</p>
                    <p class="card-text"><strong>size :</strong> <i class="fa fa-ruler-combined text-primary me-2"></i> {{ $property->size }} m²</p>
                    <p class="card-text"><strong>beds :</strong> <i class="fa fa-bed text-primary me-2"></i> {{ $property->bedrooms }}</p>
                    <p class="card-text"><strong>baths :</strong> <i class="fa fa-bath text-primary me-2"></i> {{ $property->bathrooms }}</p>
                    <p class="card-text"> <strong>Description :</strong> <i class="fa fa-info-circle text-primary me-2"></i>   {{ $property->description }}</p>                </div>
            </div>
        </div>
    </div>
</div>
@endsection
