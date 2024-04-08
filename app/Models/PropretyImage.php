<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropretyImage extends Model
{
    use HasFactory;
    public function property()
    {
        return $this->belongsTo(Proprety::class);
    }
}
