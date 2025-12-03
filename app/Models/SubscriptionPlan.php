<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'subscriptionplans';
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'features',
    ];

    /**
     * Get the subscriptions for this plan.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'subscriptionplan_id');
    }
}

