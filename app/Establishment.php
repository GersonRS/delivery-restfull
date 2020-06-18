<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'address',
        'number',
        'phone',
        'image',
        'thumbnail',
        'active',
        'minimum_value',
        'delivery_fee',
        'delivery_time_min',
        'delivery_time_max'
    ];
    public function orders()
    {
        return $this->hasMany(Order::Class);
    }
    public function opening()
    {
        return $this->hasMany(Opening::Class);
    }
    public function categories()
    {
        return $this->hasMany(Category::Class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
}
