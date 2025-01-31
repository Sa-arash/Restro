<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [

        'name',
        'phone',
        'user_id',
        'table_id',
        'order_date',
        'payment_date',
        'status',
        'total_discount',
        'total_amount',
    ];

    protected $casts = [
        'status' => InvoiceStatus::class, 
    ];

    public function items()
    {
        return $this->hasMany(ProductInvoice::class, 'invoice_id');
    } 
     public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
