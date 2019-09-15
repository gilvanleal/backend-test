<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurvivorInfected extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('survivor_infected', function (Blueprint $table) {
            $table->unsignedBigInteger('report_id');
            $table->foreign('report_id')->references('id')->on('survivors')->onDelete('CASCADE');
            $table->unsignedBigInteger('reported_id');
            $table->foreign('reported_id')->references('id')->on('survivors')->onDelete('CASCADE');
            $table->unique(['report_id', 'reported_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('survivor_infected');
    }
}
