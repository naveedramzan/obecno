<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payments';
    
    protected $fillable = [
        'company_id',
        'subscription_id',
        'invoice_id',
        'amount',
        'payment_method',
        'payment_status',
        'transaction_id',
        'payment_date',
        'currency_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /**
     * Get the company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the subscription.
     */
    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    /**
     * Get the invoice.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

