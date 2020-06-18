<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'value',
        'order',
        'active'
    ];

    public function complement()
    {
        return $this->belongsTo(Complement::class);
    }
}
