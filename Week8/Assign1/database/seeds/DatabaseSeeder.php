<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\ArticlesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->call('ArticlesTableSeeder');
    }
}
