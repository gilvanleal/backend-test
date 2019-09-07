<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Item;

class ItemTableSeeder extends Seeder
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
        Item::truncate();
        Schema::enableForeignKeyConstraints();

        Item::create(['name' => 'Water', 'point' => 4]);
        Item::create(['name' => 'Food', 'point' => 3]);
        Item::create(['name' => 'Medication', 'point' => 2]);
        Item::create(['name' => 'Ammunition', 'point' => 1]);

    }
}
