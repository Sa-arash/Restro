<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /** @use HasFactory<\Database\Factories\CategoryFactory> */

    protected $guarded = ['id'];
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
        'min_inventory',
        'special_offer'
    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
