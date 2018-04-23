<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable();
            $table->string('skuname');
            $table->boolean('active'); // only one active per sku_id 
            $table->boolean('duplex')->nullable();
            $table->integer('binding_id')->unsigned()->nullable();
            $table->integer('punch'); 
            $table->integer('batch_size');    
            $table->integer('finish_id')->unsigned()->nullable();
            $table->integer('impressions');    // total number of impressions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
