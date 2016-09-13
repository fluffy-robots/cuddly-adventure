<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldProductType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_product_type', function (Blueprint $table) {
            $table->integer('field_id')->unsigned();
            $table->integer('product_type_id')->unsigned();

            $table->foreign('field_id')
                  ->references('id')
                  ->on('fields');

            $table->foreign('product_type_id')
                  ->references('id')
                  ->on('product_types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('field_product_type');
    }
}
