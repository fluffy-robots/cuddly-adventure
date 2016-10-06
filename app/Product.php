<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function type()
    {
        return $this->belongsTo(ProductType::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function add_type($type)
    {
        return $this->type()->associate($type);
    }
}
