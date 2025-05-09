<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    /** @use HasFactory<\Database\Factories\CategoryFactory> */

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'image',
        'parent_id',
        'sort',
        'slug',
        'deleted_at',
        'created_at',
        'updated_at',
    ];





    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
       return $this->belongsTo(Category::class,'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
       return $this->hasMany(Category::class,'parent_id');
    }

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
       return $this->hasMany(Product::class,'category_id');
    }

}
