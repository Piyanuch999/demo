<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('typebooks')->insert(array(
            ["name"=>"นวนิยาย"], 
            ["name"=>"การ3ตูน"], 
            ["name"=>"ทําอาหาร"], 
            ["name"=>"บัญชี"], 
            ["name"=>"คอมพิวเตอร3"],
        ));
    }
}
