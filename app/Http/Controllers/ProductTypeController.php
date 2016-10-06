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
        foreach ($product_types as $product_type)
        {
            $product_type->load('fields');
        }
        $field_types = FieldType::all();
        return view('manufacturer.product_types',compact('product_types','field_types'));
    }

    public function destroy($id)
    {
        ProductType::findOrFail($id)->delete();
    }

    public function getProductTypes()
    {
        $product_types = ProductType::all();
        foreach ($product_types as $product_type)
        {
            $product_type->load('fields');
        }
        return $product_types;
    }

    public function store(Request $request)
    {
        if($request->id == 0)
        {
            $product_type = new ProductType();
            $product_type->name = $request->name;
            $product_type->save();

            foreach($request->fields as $field)
            {
                $new_field = new Field();
                $new_field->name = $field['name'];
                $new_field->save();

                $field_type = FieldType::find($field['field_type_id']);
                $new_field->add_type($field_type);
                $product_type->add_field($new_field);
            }
        }else{
            //exists
            $current_field_ids = array();
            $new_field_ids = array();
            $fields = array();

            $current_fields = $fields = Field::all()->where('product_type_id', 1);

            foreach ($current_fields as $field)
            {
                $current_field_ids[] = $field->id;
            }

            foreach($request->fields as $field)
            {
                if($field['id'] == 0)
                {
                    $new_field = new Field();
                }else{
                    $new_field = Field::find($field['id']);
                }
                $new_field->name = $field['name'];
                $new_field->save();

                $field_type = FieldType::find($field['field_type_id']);
                $new_field->add_type($field_type);

                $fields[] = $new_field;
                $new_field_ids[] = $new_field->id;
            }

            $trashed_field_ids = array_diff($current_field_ids, $new_field_ids);

            foreach ($trashed_field_ids as $trashed_field_id)
            {
                Field::find($trashed_field_id)->delete();
            }

            $product_type = ProductType::find($request->id);
            $product_type->name = $request->name;
            $product_type->save();
            foreach ($fields as $field)
            {
                $product_type->add_field($field);
            }
        }
    }
}
