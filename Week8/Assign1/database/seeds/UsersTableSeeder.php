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
                'password' => '123456'
            ],
            [
                'name' => 'Bilal Taher',
                'email' => 'TaherTaher', 
                'password' => '123456'
            ],
            [
                'name' => 'Youssef Kanso',
                'email' => 'Ghost', 
                'password' => '456789'
            ],
            [
                'name' => 'Mostafa Kabalan',
                'email' => 'KbMostafa', 
                'password' => '465789'
            ]
        ]);
    }
}
