<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('books')->insert(array(
            ["title"=>"การ3ตูน panda", "price"=>100, "typebooks_id"=>2],
            ["title"=>"สามกTก", "price"=>1500, "typebooks_id"=>1],
            ["title"=>"บัญชีเบื้องตYน", "price"=>500, "typebooks_id"=>4]
        ));
    }
}
