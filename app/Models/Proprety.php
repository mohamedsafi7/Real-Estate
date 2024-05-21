<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proprety extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'city', 'address', 'price', 'size', 'bedrooms', 'bathrooms', 'description', 'category_id', 'listing_type_id', 'user_id','tags'
    ];
    use HasFactory;
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function getTagsAttribute($value)
    {
        return json_decode($value);
    }
    public function getTagsArrayAttribute()
{
    return $this->tags;
}
    // public function getTagsArrayAttribute()
    // {
    //     return json_decode($this->tags);
    // }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function listingType()
    {
        return $this->belongsTo(ListingType::class);
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function images()
    {
        return $this->hasMany(PropretyImage::class, 'property_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'property_id');
    }


    
}
