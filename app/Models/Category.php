<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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
    /** @use HasFactory<\Database\Factories\CategoryFactory> */


    use HasFactory;



    public function parent(){
        $this->belongsTo(Category::class,'parent_id');
    }

    public function childs(){
        $this->hasMany(Category::class,'parent_id');
    }

}
