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
       // $this->call(OrganisasiSeeder::class);
        $this->call(PengurusSeeder::class);
        //$this->call(UsersSeeder::class);
        //$this->call(KategorisSeeder::class);
        
    }
}
