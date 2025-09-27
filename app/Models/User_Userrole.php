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
    
}
