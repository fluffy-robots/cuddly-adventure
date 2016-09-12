<?php

namespace App\Http\Controllers;

use App\Field;
use App\ProductType;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProductTypeController extends Controller
{
    public function index()
    {
        $product_types = ProductType::all();
        $fields = Field::all();
        foreach ($product_types as $product_type)
        {
            $product_type->load('fields');
            
            $product_type->html = view('manufacturer.product_types_modal',compact('product_type','fields'))->render();
        }
        return view('manufacturer.product_types',compact('product_types'));
    }
}
