<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'companysettings';
    
    protected $fillable = [
        'company_id',
        'check_in_time',
        'check_out_time',
        'grace_period',
        'working_days',
        'break_time',
        'calendar_country_id',
        'year_start_date',
        'casual_leaves',
        'sick_leaves',
        'emergency_leaves',
        'maternity_leaves',
        'paternity_leaves',
        'bereavement_leave',
        'compensation_leaves'
    ];

    protected $casts = [
        'working_days' => 'array',
        'year_start_date' => 'date',
    ];

    /**
     * Get the company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the calendar country.
     */
    public function calendarCountry()
    {
        return $this->belongsTo(Country::class, 'calendar_country_id');
    }
}

