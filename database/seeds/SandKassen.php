<?php

use Illuminate\Database\Seeder;

class SandKassen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field_type_1 = new \App\FieldType();
        $field_type_1->name = "Text";
        $field_type_1->save();
        $field_type_2 = new \App\FieldType();
        $field_type_2->name = "Description";
        $field_type_2->save();
        $field_type_3 = new \App\FieldType();
        $field_type_3->name = "Weight";
        $field_type_3->save();

        $field_1 = new \App\Field();
        $field_1->name = "Tekst";
        $field_1->save();
        $field_2 = new \App\Field();
        $field_2->name = "Beskrivelse";
        $field_2->save();
        $field_3 = new \App\Field();
        $field_3->name = "Vægt";
        $field_3->save();

        $field_1->add_type($field_type_1);
        $field_2->add_type($field_type_2);
        $field_3->add_type($field_type_3);

        $product_type = new \App\ProductType();
        $product_type->name = "Stol";
        $product_type->save();
        
        $product_type->add_field($field_1);
        $product_type->add_field($field_2);
        $product_type->add_field($field_3);

        $product = new \App\Product();
        $product->name = "Kirsten";
        $product->add_type($product_type);
        $product->save();
    }
}
