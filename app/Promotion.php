<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'value',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
