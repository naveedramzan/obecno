<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'modules';
    
    protected $fillable = [
        'title',
        'status'
    ];

    /**
     * Get the companies that have this module enabled.
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class, 'companies_modules', 'module_id', 'company_id');
    }
}

