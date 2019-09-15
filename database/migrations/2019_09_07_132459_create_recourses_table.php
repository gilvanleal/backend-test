<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recourses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedInteger('amount')->default(0);
            $table->unsignedBigInteger('item_id')->comment('Items');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('RESTRICT');
            $table->unsignedBigInteger('survivor_id')->comment('Survivors');
            $table->foreign('survivor_id')->references('id')->on('survivors')->onDelete('RESTRICT');
            $table->unique(['item_id', 'survivor_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {    
        Schema::dropIfExists('recourses');
    }
}
