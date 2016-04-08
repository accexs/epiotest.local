<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('lastname',100);
            $table->string('ci',15);
            $table->date('bdate');
            $table->string('email')->nullable();
            $table->string('meds',1000);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('recipes', function($table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipes');
    }
}
