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
        return view('manufacturer.product_types',compact('product_types'));
    }

    public function getProductTypeModal(Request $request)
    {
        if ($request->id)
        {
            $product_type = ProductType::find($request->id);
        }else {
            $product_type = new ProductType;
            $product_type->name = "";
            $product_type->save();
        }
        $fields = Field::all();
        $field_types = FieldType::all();
        $product_type->html = view('manufacturer.product_types_modal',compact('product_type','fields','field_types'))->render();
        return $product_type;
    }

    public function destroy($id)
    {
        ProductType::findOrFail($id)->delete();
    }

    public function getProductTypes()
    {
        return ProductType::all();
    }
}
