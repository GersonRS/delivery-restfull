<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'name',
        'icon',
    ];

    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
