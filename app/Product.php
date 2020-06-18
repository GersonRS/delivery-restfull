<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'active'
    ];
    public function category()
    {
        return $this->belongsTo(Category::Class);
    }
    public function promotion()
    {
        return $this->hasOne(Promotion::class);
    }
    public function complements()
    {
        return $this->hasMany(Complement::class);
    }
    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withPivot('amount', 'price')
            ->withTimestamps();
    }
}
