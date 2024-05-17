<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Reservation extends Model
{
    protected $fillable = [
        'property_id',
        'user_id',
        'check_in',
        'check_out',
        'guests',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function proprety()
    {
        return $this->belongsTo(Proprety::class, 'property_id');
    }
    public function property()
{
    return $this->belongsTo(Proprety::class);
}

}
