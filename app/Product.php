<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function product_types()
    {
        return $this->hasOne(ProductType::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
