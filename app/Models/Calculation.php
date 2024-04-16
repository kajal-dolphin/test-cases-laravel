<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calculation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['value1','value2','operation','calculated_percentage','created_at','updated_at','deleted_at'];
}
