
                        @extends('layouts.app')

                        @section('content')
                        <div class="container">
                            <div class="row" enctype="multipart/form-data" id="property-list">
                                                        <!-- Search Start -->
                        <div class="container-fluid bg-primary mb-4 wow fadeIn mt-4" data-wow-delay="0.1s" style="padding: 35px;">
                            <div class="container">
                                <form action="{{ route('filter.properties') }}" method="GET" class="row g-2">
                                    <div class="col-md-10">
                                        <div class="row g-2">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control border-0 py-3" placeholder="Search Keyword">
                                            </div>
                                            <div class="col-md-4">
                                                <select class="form-select border-0 py-3" name="category_filter" id="category_filter">
                                                    <option selected>Property Category</option>
                                                    @foreach ($categories as $category)
                                                        <option>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="col-md-4 position-relative">
                                                <input id="location" name="location" type="text" list="location_datalist" class="form-control border-0 py-3" placeholder="Location">
                                                <datalist id="location_datalist">
                                                    <option selected disabled>Location</option>
                                                    @php
                                                        $uniqueCities = $listings->unique('city');
                                                    @endphp
                                                    @foreach ($uniqueCities as $property)
                                                        <option>{{ $property->city }}</option>
                                                    @endforeach
                                                </datalist>
                                                {{-- <i class="bi bi-search position-absolute top-50 start-50 translate-middle" style="transform: translate(-50%, -50%);"></i> --}}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-dark border-0 w-100 py-3">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Search End -->
                                <!-- Filter buttons -->
                                <div class="col-md-12 mb-3 mt-1">
                                    <button class="btn btn-primary me-2 filter-btn" data-filter="all">All</button>
                                    <button class="btn btn-outline-primary filter-btn" data-filter="sell">For Sale</button>
                                    <button class="btn btn-outline-primary filter-btn" data-filter="rent">For Rent</button>
                                </div>
                        

                                @foreach ($properties as $property)
                                <div class="col-lg-4 col-md-6 wow fadeInUp property-item" data-listing="{{ $property->listingType->name }}" data-category="{{ $property->category->name }}">
                                    <div class="property-item rounded overflow-hidden mt-2">
                                        <div class="position-relative overflow-hidden" style="height: 250px;">
                                            <!-- Display property type -->
                                            @if ($property->listingType->name == 'sell')
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sale</div>
                                            @else
                                            <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                            @endif
                        
                                            <!-- Display property category -->
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $property->category->name }}</div>
                        
                                            <!-- Display property image -->
                                            @if ($property->images->count() > 0)
                                            <a class="d-block h5 mb-2" href="{{ route('property.show', ['id' => $property->id]) }}"><img class="img-fluid" style="height: 300px;" src="{{ asset('storage/images/' . $property->images->first()->image_path) }}" alt=""></a>
                                            @endif
                                        </div>
                        
                                        <!-- Property details -->
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">${{ $property->price }}</h5>
                                            <a class="d-block h5 mb-2" href="{{ route('property.show', ['id' => $property->id]) }}">{{ $property->name }}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
                                            
                                        </div>
                        
                                        <!-- Display property features -->
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->size }} m²</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms }} Bed</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }} Bath</small>
                                        </div>
                        
                                        @if (Auth::user()->isAdmin())
                                        <div class="mt-3 text-center">
                                            <form action="{{ route('admin.deleteProperty', ['id' => $property->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
$(document).ready(function() {
    $(".filter-btn").click(function() {
        var filter = $(this).data("filter");
        console.log("Filter clicked:", filter);

        $(".property-item").each(function() {
            var listingType = $(this).data("listing");
            console.log("Property listing type:", listingType);

            if (filter === "all" || filter === listingType) {
                $(this).fadeIn();
            } else {
                $(this).fadeOut();
            }
        });
    });
});

                        </script>
                        @endsection
                        

