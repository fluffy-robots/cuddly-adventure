<?php

namespace App\Http\Controllers;

use App\Field;
use App\FieldType;
use App\ProductType;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductTypeController extends Controller
{
    public function index()
    {
        $product_types = ProductType::all();
        $fields = Field::all();
        $field_types = FieldType::all();
        foreach ($product_types as $product_type)
        {
            $product_type->load('fields');
            
            $product_type->html = view('manufacturer.product_types_modal',compact('product_type','fields','field_types'))->render();
        }
        return view('manufacturer.product_types',compact('product_types'));
    }

    public function getProductTypeModal()
    {
        $data = "";
        $html = view('modal_view',compact('data'))->render();
        return $html;
    }
}
