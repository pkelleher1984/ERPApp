<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned()->nullable();
            $table->integer('batch_number')->unsigned()->nullable();
            $table->enum('action', array('Print', 'Bind', 'Box','Build'));
            $table->integer('batch_size')->unsigned()->nullable();
            $table->integer('progress')->unsigned()->nullable();
            $table->boolean('is_complete')->unsigned()->nullable();
            $table->char('resource_id')->nullable();
            $table->char('user_id')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
