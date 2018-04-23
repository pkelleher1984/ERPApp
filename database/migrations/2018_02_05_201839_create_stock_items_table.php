<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   Schema::create('stock_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',25);
            $table->string('desc');
            $table->boolean('active');      // only one active per 'name'
            $table->boolean('for_sale');  // not make internally
            $table->string('ver',12);       // e.g. 3.4.2.1
            $table->integer('prodType_id')->unsigned()->nullable();
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
        Schema::dropIfExists('stock_items');
    }
}
