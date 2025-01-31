<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductInvoice extends Model
{
    /** @use HasFactory<\Database\Factories\ProductInvoiceFactory> */
    use HasFactory, SoftDeletes;
    protected $guarded = ['id'];
    protected $fillable = [
        'invoice_id',
        'product_id',
        'price',
        'count',
        'discount',
        'total',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
