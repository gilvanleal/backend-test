<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Survivor;
use App\Recourse;
use App\Item;

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
        Recourse::truncate();
        Survivor::truncate();
        Schema::enableForeignKeyConstraints();

        $s = Survivor::create(['name' => 'Gilvan Leal', 'birth' => '1990-10-19',
         'gender' => 'male', 'latitude'=> 10.123456, 'longitude'=> 20.654321
         ]);
         $s->recourses()->createMany([
            ['amount' => 2, 'item_id' => Item::where('name', 'Water')->value('id')],
            ['amount' => 1, 'item_id' => Item::where('name', 'Medication')->value('id')],
            ['amount' => 4, 'item_id' => Item::where('name', 'Ammunition')->value('id')]
         ]
        );
        $s->save();
        Survivor::create(['name' => 'Dywlly Porto', 'birth' => '1985-11-08',
         'gender' => 'female', 'latitude'=> 50.123456, 'longitude'=> 90.654321
         ])->recourses()->createMany([
            ['amount' => 1, 'item_id' => Item::where('name', 'Water')->value('id')],
            ['amount' => 2, 'item_id' => Item::where('name', 'Medication')->value('id')]
         ]
        );
        Survivor::create(['name' => 'João Paulo', 'birth' => '1999-12-5',
         'gender' => 'male', 'latitude'=> 50.123456, 'longitude'=> 90.654321
         ])->recourses()->createMany([
            ['amount' => 1, 'item_id' => Item::where('name', 'Water')->value('id')],
            ['amount' => 2, 'item_id' => Item::where('name', 'Medication')->value('id')]
         ]
        );

        Survivor::create(['name' => 'Paulo Silva', 'birth' => '2012-12-5',
         'gender' => 'male', 'latitude'=> 50.123456, 'longitude'=> 90.654321
         ])->recourses()->createMany([
            ['amount' => 10, 'item_id' => Item::where('name', 'Food')->value('id')],
            ['amount' => 2, 'item_id' => Item::where('name', 'Ammunition')->value('id')]
         ]
        );


    }
}
