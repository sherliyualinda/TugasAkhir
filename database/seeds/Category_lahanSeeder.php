<?php

use Illuminate\Database\Seeder;

class Category_lahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Model\Category_lahan::insert([
            ['name' =>'Pertanian',],
            ['name' =>'Perkebunan',],
            ['name' =>'Perikanan',],
            ['name' =>'Peternakan',],
        ]);
    }
}
