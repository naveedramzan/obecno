<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_Module extends Model
{
    use HasFactory;

    protected $table = 'companies_modules';
    
    protected $fillable = [
        'company_id',
        'module_id'
    ];

    /**
     * Get the company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the module.
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}

