@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="{{ asset('css/show.css') }}" rel="stylesheet">

@section('content')
        <!-- Header Start -->
        <div class="container-fluid header bg-white p-0">
            <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
                <div class="col-md-6 p-5 mt-lg-5">
                    <h1 class="display-5 animated fadeIn mb-4">Find A <span class="text-primary">Perfect Place</span> To Live With Your Family</h1>
                    <p class="animated fadeIn mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet
                        sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                    <a href="" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Get Started</a>
                </div>
                <div class="col-md-6 animated fadeIn">
                    <div class="owl-carousel header-carousel">
                        <div class="owl-carousel-item">
                            <img class="" src="{{ asset('img/carousel-1.jpg') }}" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
                <!-- Search Start -->
                <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
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
                <div class="container-xxl bg-white p-0">
                    <!-- Spinner Start -->
                    {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div> --}}
                    <!-- Spinner End -->

                    <!-- Category Start -->

<!-- Category End -->
            
                    <!-- About Start -->
                    <div class="container-xxl py-5">
                        <div class="container">
                            <div class="row g-5 align-items-center">
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                                        <img class="img-fluid w-100" src="{{ asset('img/about.jpg') }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                                    <h1 class="mb-4">#1 Place To Find The Perfect Property</h1>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit impedit a optio libero id sapiente consequatur cupiditate repellat, repellendus reprehenderit, dignissimos quae quisquam esse perspiciatis. Rem quasi tenetur in magni!</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                                    <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- About End -->        
            
                    <div class="container">
                        <div class="row" enctype="multipart/form-data" id="property-list">
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-primary me-2" id="rent-btn">For Rent</button>
                                <button class="btn btn-outline-primary" id="sell-btn">For Sale</button>
                            </div>
                            @foreach ($properties as $property)
                            <div class="col-lg-4 col-md-6 property-item wow fadeInUp" data-wow-delay="0.1s" data-listing-type="{{ $property->listingType->name }}">
                                <div class="property-item rounded overflow-hidden mb-4"> 
                                    <div class="position-relative overflow-hidden" style="height: 250px;"> 
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $property->category->name }}</div>
                                        @if ($property->images->count() > 1)
                                            <div id="propertyCarousel_{{ $property->id }}" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
                                                <div class="carousel-inner">
                                                    @foreach ($property->images as $key => $image)
                                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                             <a class="d-block h5 mb-2" href="{{ route('property.show', ['id' => $property->id]) }}"><img style="height: 300px;" class="d-block w-100 img-fluid" src="{{ asset('storage/images/' . $image->image_path) }}" alt=""></a>
                                                            @if ($property->listingType->name == 'sell')
                                                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                                            @else
                                                                <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#propertyCarousel_{{ $property->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#propertyCarousel_{{ $property->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        @elseif ($property->images->count() == 1)
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}"><img style="height: 300px;" class="img-fluid" src="{{ asset('storage/images/' . $property->images->first()->image_path) }}" alt=""></a>
                                            @if ($property->listingType->name == 'sell')
                                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                                            @else
                                                <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                                            @endif
                                        @endif
                                    </div>
                                    
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">{{ $property->price }} DH</h5>
                                        <a class="d-block h5 mb-2" href="{{ route('property.show', ['id' => $property->id]) }}">{{ $property->name }}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->city }}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->size }} m&sup2;</small>
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms }} Bed</small>
                                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }} Bath</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                    
                        
                <!-- Team Start -->
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                            <h1 class="mb-3">Top Property Agents</h1>
                            <p>presents a curated selection of the most prolific individuals within our real estate ecosystem. These agents have distinguished themselves by overseeing a substantial number of properties, showcasing their expertise and dedication to facilitating successful transactions.</p>
                        </div>
                        <div class="row g-4">
                            @foreach ($topUsers as $user)
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item rounded overflow-hidden">
                                    <div class="position-relative">
                                        @if ($user->image)
                                        <img class="img-fluid"  style="width: 310px; height:250px; "  src="{{ asset('storage/users/' . $user->image) }}" alt="{{ $user->name }}">
                                    @else
                                        <img class="img-fluid" src="{{ asset('generic.jpg') }}" alt="Anonymous">
                                    @endif                                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                            <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center p-4 mt-3">
                                        <h5 class="fw-bold mb-0">{{ $user->name }}</h5>
                                        <small>{{ $user->email }}</small>
                                        <p>Total Properties: {{ $user->properties_count }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Team End -->
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                            <h1 class="mb-3">Most Popular Visited Cities</h1>
                            <p>presents a curated selection of the most prolific individuals within our real estate ecosystem. These agents have distinguished themselves by overseeing a substantial number of properties, showcasing their expertise and dedication to facilitating successful transactions.</p>
                        </div>
                        <div class="row g-4">
                            @foreach ($topCities as $city)
                            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="team-item rounded overflow-hidden">
                                    <div class="text-center p-4 mt-3">
                                        <h5 class="fw-bold mb-0">{{ $city->city }}</h5>
                                        <img style="width: 310px; height:250px; " class="img-fluid" src="img/{{ $city->city }}.jpg" alt="Icon">
                                        <p>{{ $city->property_count }} properties</p>

                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
                    <!-- Back to Top -->
                    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
                </div>
<script>
    $('#your-form-id').on('submit', e => {
    $('#error').empty();
    let form = $(e.target);d
    let validOptions = form.find('#location_datalist option').map((key, option) => option.value).toArray();
    let customField1Value = form.find('input[name=location]').eq(0).val();

    // check if custom_field_1's value is in the datalist. If it's not, it's an invalid choice
    if ( !(validOptions.indexOf(customField1Value) > -1) ) {
        // show error
        $('#error').text('Invalid Choice');
        // prevent form submission (you should still validate in the backend)
        e.preventDefault();
    }
});
</script>
<script>
$(document).ready(function() {
    $('#category_filter').on('change', function() {
        fetchFilteredProperties();
    });

    $('#search-button').on('click', function(e) {
        e.preventDefault();
        fetchFilteredProperties();
    });

    function fetchFilteredProperties() {
        var category = $('#category_filter').val();
        var location = $('#location').val();

        $.ajax({
            url: '{{ route("filter.properties") }}',
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                category: category,
                location: location
            },
            success: function(response) {
                $('#property-list').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});

</script>

@endsection