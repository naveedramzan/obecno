<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscriptions';
    
    protected $fillable = [
        'company_id',
        'subscriptionplan_id',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /**
     * Get the company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the subscription plan.
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscriptionplan_id');
    }

    /**
     * Get the invoices for this subscription.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the payments for this subscription.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

