<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    protected $guarded=['id'];

    public function table(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
}
