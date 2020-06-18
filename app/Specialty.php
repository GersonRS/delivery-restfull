<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $fillable = [
        'name'
    ];

    public function establishments()
    {
        return $this->belongsToMany(Establishment::class);
    }
}
