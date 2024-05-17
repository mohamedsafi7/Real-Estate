<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $reservations = Reservation::whereHas('proprety', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('proprety', 'user')->get();
    
        return view('dashboard', compact('reservations'));
    }
    
    

    public function approve(Reservation $reservation)
    {
        $reservation->status = 'approved';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation approved successfully');
    }

    public function reject(Reservation $reservation)
    {
        $reservation->status = 'rejected';
        $reservation->save();

        return redirect()->back()->with('success', 'Reservation rejected successfully');
    }
}

