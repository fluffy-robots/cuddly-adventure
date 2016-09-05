<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class uiElement extends Model
{
    public function updateViewFile($element)
    {
        if(!$this->file_path)
        {
            $this->file_path = 'ui-elements/elements/'.time() . '_' . $element->name;
        }
        File::put(base_path('resources/views/'.$this->file_path.'.blade.php'), $element->code);
    }
}
