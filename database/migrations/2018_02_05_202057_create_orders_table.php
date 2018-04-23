<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
  Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable();
            $table->text('description')->nullable()->default(null);
            $table->enum('status', array('Planned', 'Hold', 'Active', 'Complete', 'Cancelled'));
            $table->timestamp('date_order')->nullable();
            $table->integer('qty_order')->default(1);
            $table->timestamp('date_due')->nullable();
            $table->timestamp('date_complete')->nullable()->default(null);
            $table->integer('qty_complete')->default(0);
            $table->integer('impressions')->nullable();
            $table->integer('batch_size'); 
            $table->integer('priority'); 
            $table->text('notes')->nullable()->default(null);
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
        Schema::dropIfExists('orders');
    }
}
