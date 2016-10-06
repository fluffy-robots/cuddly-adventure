<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class FieldTypeController extends Controller
{
    public function destroy($id)
    {
        FieldType::findOrFail($id)->delete();
    }
}
