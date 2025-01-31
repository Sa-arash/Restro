<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'fullname',
        'phone',
        'user_id',
        'order_date',
        'payment_date',
        'status',
        'total_discount',
        'total',
    ];

    public function products()
    {
        return $this->hasMany(ProductInvoice::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
