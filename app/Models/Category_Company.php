<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category_Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories_companies';

    protected $primaryKey = 'id';
    
}
