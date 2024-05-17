<?php

namespace App\Http\Controllers;

use App\Models\Proprety;
use App\Models\Reservation;
use App\Notifications\ReservationStatusNotification;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(){
        return view('proprety.reservations');
    }
    public function store(Request $request, Proprety $property)
    {
        // Validate the request data
        $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->property_id = $property->id;
        $reservation->user_id = auth()->id(); // Assuming the user is authenticated
        $reservation->check_in = $request->input('check_in');
        $reservation->check_out = $request->input('check_out');
        $reservation->guests = $request->input('guests');
        $reservation->save();

        // Redirect with a success message
        return redirect()->route('property.show', $property->id)
                         ->with('success', 'Reservation made successfully!');
    }
    // In your ReservationController

    public function approve($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'approved';
        $reservation->save();
    
        $reservation->user->notify(new ReservationStatusNotification($reservation));
    
        return redirect()->back()->with('success', 'Reservation approved successfully');
    }
    
    public function reject($id)
    {
        $reservation = Reservation::find($id);
        $reservation->status = 'rejected';
        $reservation->save();
    
        $reservation->user->notify(new ReservationStatusNotification($reservation));
    
        return redirect()->back()->with('success', 'Reservation rejected successfully');
    }
    public function destroy($id)
{
    $reservation = Reservation::findOrFail($id);

    // Check if the logged-in user is the owner of the reservation
    if ($reservation->user_id != auth()->id()) {
        return redirect()->route('profile')->with('error', 'You are not authorized to delete this reservation.');
    }

    $reservation->delete();

    return redirect()->route('profile')->with('success', 'Reservation deleted successfully.');
}

}

