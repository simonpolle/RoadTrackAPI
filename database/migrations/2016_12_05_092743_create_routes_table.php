<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table){
            $table->increments('id');
            $table->string('user_id')->references('id')->on('users');
            $table->string('car_id')->references('id')->on('cars');
            $table->double('distance_travelled');
            $table->double('total_cost');
            $table->string('cost_id')->references('id')->on('costs');
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
        Schema::drop('routes');
    }
}
