<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'invoices';
    
    protected $fillable = [
        'company_id',
        'subscriptionplan_id',
        'subscription_id',
        'discount_id',
        'invoice_date',
        'expiry_date',
        'total_amount',
        'any_discount',
        'currency_id',
        'final_payable',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'expiry_date' => 'date',
        'total_amount' => 'decimal:2',
        'any_discount' => 'decimal:2',
        'final_payable' => 'decimal:2',
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
     * Get the subscription.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the discount.
     */
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    /**
     * Get the payment for this invoice.
     */
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

