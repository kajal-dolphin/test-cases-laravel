<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['name','description','category_id','author','price','category_id','created_at','updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
