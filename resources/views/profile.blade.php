@extends('layouts.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<div class="container" enctype="multipart/form-data">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-6 wow fadeInUp mb-4" data-wow-delay="0.3s">
            <div class="team-item rounded overflow-hidden">
                <div class="position-relative" >
                                    
                @if ($user->image)
                    <img class="img-fluid" src="{{ asset('storage/uploads/' . $user->image) }}" alt="{{ $user->name }}">
                @else
                    <img class="img-fluid" src="{{ asset('generic.jpg') }}" alt="Anonymous">
                @endif
                    <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="text-center p-4 mt-3">
                    @auth
                    <h5 class="fw-bold mb-0">{{ auth()->user()->name }}</h5>
                    <small>{{ auth()->user()->email }}</small>
                    <a href="{{ route('profile.edit', $user->id) }}"><i class="fas fa-pen"></i></a>

                    @endauth
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($pubs as $pub)
        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            <div class="property-item rounded overflow-hidden">
                <div class="position-relative overflow-hidden">
                    @if ($pub->listingType->name == 'sell')
                    <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Sell</div>
                    @else
                    <div class="bg-warning rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">For Rent</div>
                    @endif
                    <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{ $pub->category->name }}</div>
                    @foreach ($pub->images as $image)
                        <a href=""><img class="img-fluid" src="{{ asset('storage/images/' . $image->image_path) }}" alt=""></a>

                    @endforeach
                </div>
                <div class="p-4 pb-0">
                    <h5 class="text-primary mb-3">${{ $pub->price }}</h5>
                    <a class="d-block h5 mb-2" href="">{{ $pub->name }}</a>
                    <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $pub->address }}</p>
                    
                    <div class="d-flex justify-content-end mt-2">
                        <div>
                            <form action="{{ route('deleteproperty', $pub->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-link p-1"><i class="fas fa-trash mr-2"></i></button>
                            </form>
                        </div>
                        <div>
                            <a href="{{ route('editproperty', $pub->id) }}"><i class="fas fa-pen"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex border-top">
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{ $pub->size }} Sqft</small>
                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{ $pub->bedrooms }} Bed</small>
                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{ $pub->bathrooms }} Bath</small>
                </div>
                {{-- <a href="{{route('editproperty',$pub->id)}}"><i class="fas fa-pen"></i> </a> --}}

                
                
                
                {{-- <form action="{{ route('deleteproperty', $pub->id) }}" method="POST">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-link p-0"><i class="fas fa-trash"></i></button>
                </form> --}}
                
            </div>
        </div>
        @endforeach
    </div>
</div>


@endsection
