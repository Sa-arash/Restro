<?php

namespace App\Models;

use App\Enums\Coupon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Copon extends Model
{
    /** @use HasFactory<\Database\Factories\CoponFactory> */
    use HasFactory,SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'token',
        'start_date',
        'end_date',
        'min_price',
        'max_price',
        'status',
        'description',
        'discount',
    ];
    protected $casts=['status'=>Coupon::class];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
