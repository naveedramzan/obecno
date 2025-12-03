<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;//, SoftDeletes

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'name',
        'email',
        'phone',
        'password',
        'city_id',
        'country_id',
        'slug',
        'username',
        'date_of_birth',
        'photo',
        'cnic',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
    ];

    /**
     * Get the user roles for the user.
     */
    public function userRoles()
    {
        return $this->hasMany(User_Userrole::class, 'user_id');
    }

    /**
     * Get the city for the user.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the country for the user.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
