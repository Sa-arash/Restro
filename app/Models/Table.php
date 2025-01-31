<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\FreeUse;
class Table extends Model
{
    /** @use HasFactory<\Database\Factories\TableFactory> */
    use HasFactory,SoftDeletes;

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
    protected $casts = [
        'status' => FreeUse::class, 
    ];

    public function invoices(){
        return $this->hasMany(Invoice::class , 'table_id');
    }
}
