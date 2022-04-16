<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
<<<<<<< Updated upstream
        $this->call(TasksTableSeeder::class);
		$this->call(LinksTableSeeder::class);
=======
        $this->call(Category_lahanSeeder::class);
>>>>>>> Stashed changes
    }
}
