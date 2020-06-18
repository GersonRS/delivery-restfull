<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    protected $fillable = [
        'weekday',
        'start',
        'end',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
