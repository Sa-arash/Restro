<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'images',
        'description',
        'category_id',
        'price',
        'discount',
        'discount_end',
        'inventory',
        'slug',
    ];

    public function category(){
        $this->belongsTo(Category::class , 'category_id');
    }
}
