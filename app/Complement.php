<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complement extends Model
{
    protected $fillable = [
        'name',
        'min',
        'max',
        'mandatory',
        'order',
        'active'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
