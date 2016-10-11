<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function parent()
    {
    	return $this->belongsTo(File::class);
    }
}
