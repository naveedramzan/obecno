<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeLocation extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'locations';

    protected $fillable = [
        'company_id',
        'title',
        'address',
        'phone',
        'email',
        'lat_lon',
        'timezone_id',
        'user_id',
        'city_id'
    ];

    /**
     * Get the company that owns the office location.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the timezone for the office location.
     */
    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }

    /**
     * Get the user who created the office location.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the city for the office location.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

