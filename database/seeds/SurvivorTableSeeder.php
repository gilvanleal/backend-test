<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Survivor;
use App\Recourse;

class SurvivorTableSeeder extends Seeder
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
        Survivor::truncate();
        Schema::enableForeignKeyConstraints();

        Survivor::create(['name' => 'Gilvan Leal', 'birth' => '1990-10-19',
         'gender' => 'male', 'latitude'=> 10.123456, 'longitude'=> 20.654321
         ])->recourses()->createMany([
            ['amount' => 2, 'item_id' => 1],
            ['amount' => 1, 'item_id' => 3],
            ['amount' => 4, 'item_id' => 4],
         ]
        );
        Survivor::create(['name' => 'Dywlly Porto', 'birth' => '1985-11-08',
         'gender' => 'female', 'latitude'=> 50.123456, 'longitude'=> 90.654321
         ])->recourses()->createMany([
            ['amount' => 1, 'item_id' => 1],
            ['amount' => 2, 'item_id' => 3]
         ]
        );
        Survivor::create(['name' => 'João Paulo', 'birth' => '1999-12-5',
         'gender' => 'male', 'latitude'=> 50.123456, 'longitude'=> 90.654321
         ])->recourses()->createMany([
            ['amount' => 1, 'item_id' => 1],
            ['amount' => 2, 'item_id' => 3]
         ]
        );


    }
}
