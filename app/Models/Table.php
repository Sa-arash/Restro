<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'code',
        'status',
        'description',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function category(){
        $this->belongsTo(Category::class , 'category_id');
    }
}
