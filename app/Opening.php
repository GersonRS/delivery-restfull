<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opening extends Model
{
    protected $fillable = [
        'weekday',
        'start',
        'end',
        'active'
    ];
    public function establishment()
    {
        return $this->belongsTo(Establishment::class);
    }
}
