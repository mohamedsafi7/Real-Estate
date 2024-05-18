@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body p-0">
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
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">{{ $property->name }}</h3>
                    <p class="card-text"><strong>Category:</strong> <span style="text-transform: uppercase;">{{ $property->category->name }}</span></p>
                    <p class="card-text"><strong>City:</strong> <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->city }}</p>
                    <p class="card-text"><strong>Address:</strong> <i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
                    <p class="card-text"><strong>Price:</strong> <i class="fa fa-money-bill-alt text-primary me-2"></i>{{ $property->price }}DH</p>
                    <p class="card-text"><strong>Size:</strong> <i class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->size }} m²</p>
                    <p class="card-text"><strong>Beds:</strong> <i class="fa fa-bed text-primary me-2"></i>{{ $property->bedrooms }}</p>
                    <p class="card-text"><strong>Baths:</strong> <i class="fa fa-bath text-primary me-2"></i>{{ $property->bathrooms }}</p>
                    <p class="card-text"><strong>Description:</strong> <i class="fa fa-info-circle text-primary me-2"></i>{{ $property->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if (!auth()->check() || auth()->user()->id != $property->owner->id)
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img class="img-fluid rounded-circle mb-3" src="{{ asset('storage/users/' . $property->owner->image) }}" alt="{{ $property->owner->name }}" style="width: 150px;">
                        <h4><strong>Owner:</strong> {{ $property->owner->name }}</h4>
                        {{-- @if ($property->reservation && $property->reservation->status == 'rejected')
                            <p>Email and phone number will be visible upon approval.</p>
                        @else
                            <p><i class="fa fa-envelope text-primary me-2"></i>{{ $property->owner->email }}</p>
                            <p><i class="fa fa-phone text-primary me-2"></i>{{ $property->owner->phone }}</p>
                        @endif --}}
                    </div>
                </div>
            @endif

            @if (auth()->check() && auth()->user()->id == $property->owner->id)
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Reservation Requests</h4>
                        @if ($property->reservations->isEmpty())
                            <p>No reservation requests found.</p>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Guest</th>
                                        <th>Check-in</th>
                                        <th>Check-out</th>
                                        <th>Guests</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($property->reservations as $reservation)
                                        @if ($reservation->status != 'rejected')
                                        <tr>
                                            <td>{{ $reservation->user->name }}</td>
                                            <td>{{ $reservation->check_in }}</td>
                                            <td>{{ $reservation->check_out }}</td>
                                            <td>{{ $reservation->guests }}</td>
                                            <td>
                                                @if ($reservation->status == 'pending')
                                                    <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                                    </form>
                                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-sm mt-1">Reject</button>
                                                    </form>
                                                @elseif ($reservation->status == 'approved')
                                                    <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning btn-sm">Unapprove</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            @else
            @php
            $userReservation = $property->reservations->where('user_id', auth()->id())->first();
            @endphp
            
            @if ($userReservation)
                <div class="card">
                    <div class="card-body text-center">
                        @if ($userReservation->status == 'approved')
                            <h4 class="card-title text-success">Reservation request approved</h4>
                            <h4>CONTACT THE OWNER :</h4>
                            <p><i class="fa fa-envelope text-primary me-2"></i>{{ $property->owner->email }}</p>
                            <p><i class="fa fa-phone text-primary me-2"></i>{{ $property->owner->phone }}</p>
                            @elseif  ($userReservation->status == 'rejected')
                            <h4 class="card-title text-danger">Reservation request Rejected</h4> 
                            @else
                            <h4 class="card-title">Reservation request sent</h4>
                            <p>You have already sent a reservation request for this property.</p>                      
                            @endif 
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title">Reserve this property</h4>
                        <form action="{{ route('reservations.store', $property->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="check-in" class="form-label">Check-in</label>
                                <input type="date" id="check-in" name="check_in" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="check-out" class="form-label">Check-out</label>
                                <input type="date" id="check-out" name="check_out" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label">Guests</label>
                                <input type="number" id="guests" name="guests" class="form-control" value="1" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Reserve</button>
                        </form>
                    </div>
                </div>
            @endif
            
            @endif
        </div>
    </div>
</div>
@endsection