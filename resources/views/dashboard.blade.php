@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Owner Dashboard</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h4>Reservations</h4>
        </div>
        <div class="card-body">
            @if($reservations->isEmpty())
                <p>No reservations found.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>Property</th>
                            <th>Guest</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $reservation)
                            <tr>
                                <td>{{ optional($reservation->proprety)->name }}</td>
                                <td>{{ optional($reservation->user)->name }}</td>
                                <td>{{ $reservation->check_in }}</td>
                                <td>{{ $reservation->check_out }}</td>
                                <td>{{ $reservation->guests }}</td>
                                <td>{{ ucfirst($reservation->status) }}</td>
                                <td>
                                    @if($reservation->status == 'pending')
                                        <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                        <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                        </form>
                                    @elseif($reservation->status == 'approved')
                                        <form action="{{ route('reservations.reject', $reservation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-warning btn-sm">Unapprove</button>
                                        </form>
                                    @elseif($reservation->status == 'rejected')
                                        <form action="{{ route('reservations.approve', $reservation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
