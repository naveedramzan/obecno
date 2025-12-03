<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Userrole extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'users_userroles';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'userrole_id',
        'company_id',
        'location_id',
        'department_id',
    ];

    /**
     * Get the user that owns the user role.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the userrole that owns the user role.
     */
    public function userrole()
    {
        return $this->belongsTo(Userrole::class, 'userrole_id');
    }

    /**
     * Get the company that owns the user role.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the location that owns the user role.
     */
    public function location()
    {
        return $this->belongsTo(OfficeLocation::class, 'location_id');
    }

    /**
     * Get the department that owns the user role.
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
