<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        foreach ($products as $product)
        {
            if($product->type()->first())
            {
                foreach ($product->type->fields as $field)
                {
                    $field->load('type');
                }
                $product->info = json_decode($product->info);
            }
        }
        $product_types = ProductType::all();
        foreach ($product_types as $product_type)
        {
            foreach ($product_type->fields as $field)
            {
                $field->load('type');
            }
        }
        return view('manufacturer.products',compact('products','product_types'));
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function getProducts()
    {
        $products = Product::all();
        foreach ($products as $product)
        {
            if($product->type()->first())
            {
                foreach ($product->type->fields as $field)
                {
                    $field->load('type');
                }
                $product->info = json_decode($product->info);
            }
        }
        return $products;
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required'
        ])->validate();

        $product_type = ProductType::find($request->type_id);
        if($request->id == 0){
            $product = New Product();
        }else{
            $product = Product::find($request->id);
        }
        $product->name = $request->name;
        $product->info = json_encode($request->info);
        $product->type()->associate($product_type);
        $product->save();
    }
}
