<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Hussein Ismail',
                'email' => 'husisma', 
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Bilal Taher',
                'email' => 'TaherTaher', 
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Youssef Kanso',
                'email' => 'Ghost', 
                'password' => bcrypt('456789')
            ],
            [
                'name' => 'Mostafa Kabalan',
                'email' => 'KbMostafa', 
                'password' => bcrypt('465789')
            ]
        ]);
    }
}
