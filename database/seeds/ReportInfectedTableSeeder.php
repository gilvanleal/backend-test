<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportInfectedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('survivor_infected')->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
