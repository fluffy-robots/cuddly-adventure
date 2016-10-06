<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function add_field($field)
    {
        return $this->fields()->save($field);
    }
}
