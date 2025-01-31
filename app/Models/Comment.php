<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'reply',
        'user_id',
        'product_id',
        'comment',
        'star',
        'is_show',
    ];

    protected $casts = [
        'reply' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
