<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function type()
    {
        return $this->belongsTo(FieldType::class,'field_type_id');
    }

    public function add_type($field_type)
    {
        return $this->type()->associate($field_type);
    }
}
