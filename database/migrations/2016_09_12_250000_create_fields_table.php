<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('field_type_id')->nullable()->unsigned();
            $table->integer('product_type_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('field_type_id')
                  ->references('id')
                  ->on('field_types');

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
        Schema::drop('fields');
    }
}
