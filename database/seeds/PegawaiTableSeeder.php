<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PegawaiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        for ($i=0; $i < 10; $i++) { 
        	DB::table('pegawai')->insert([
        		'pegawai_nama'=>$faker->name,
        		'pegawai_jabatan'=>$faker->jobTitle,
        		'pegawai_umur'=>$faker->numberBetween(20,50),
        		'pegawai_alamat'=>$faker->address
        		]);
        }
    }
}
