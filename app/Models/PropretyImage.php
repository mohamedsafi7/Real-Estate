<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropretyImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
         'image_path'
    ];
    public function property()
    {
        return $this->belongsTo(Proprety::class, 'property_id');
    }
}
