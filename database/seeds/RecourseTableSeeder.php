<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Recourse;

class RecourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        Recourse::truncate();
        Schema::enableForeignKeyConstraints();
    }
}
