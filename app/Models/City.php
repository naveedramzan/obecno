<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'country_id'
    ];

    /**
     * Get the country that owns the city.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
