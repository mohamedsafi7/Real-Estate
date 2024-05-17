@extends('layouts.app')
@section('content')
<div class="container" enctype="multipart/form-data">
    <div class="row justify-content-center">
        <div class="row">
            @if(auth()->check() && auth()->user()->reservations->count() > 0)
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">My Reservation Requests</h4>
                            <ul class="list-group list-group-flush">
                                @foreach(auth()->user()->reservations as $reservation)
                                    @if ($reservation->property)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    @if ($reservation->property->images->count() > 0)
                                                        <img class="img-fluid" src="{{ asset('storage/images/' . $reservation->property->images->first()->image_path) }}" alt="Property Image">
                                                    @else
                                                        <img class="img-fluid" src="{{ asset('generic.jpg') }}" alt="No Image">
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <h5>{{ $reservation->property->name }}</h5>
                                                    <p>
                                                        <strong>Status:</strong> 
                                                        <span class="
                                                            @if($reservation->status == 'approved') text-success
                                                            @elseif($reservation->status == 'rejected') text-danger
                                                            @elseif($reservation->status == 'pending') text-warning
                                                            @endif
                                                        ">
                                                            {{ ucfirst($reservation->status) }}
                                                        </span>
                                                    </p>
                                                    <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
                                                    <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>
                                                    <p><strong>City:</strong> {{ $reservation->property->city }}</p>
                                                    <p><strong>Address:</strong> {{ $reservation->property->address }}</p>
                                                    <p><strong>Price:</strong> {{ $reservation->property->price }}DH</p>
                                                    <p><strong>Beds:</strong> {{ $reservation->property->bedrooms }}</p>
                                                    <p><strong>Baths:</strong> {{ $reservation->property->bathrooms }}</p>

                                                    <!-- Delete button -->
                                                    <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this reservation?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete Reservation</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5>Property not found</h5>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
