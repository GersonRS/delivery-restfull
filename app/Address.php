<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address',
        'city',
        'neighborhood',
        'number',
        'complement',
        'active'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
