<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'ArticleTitle' => 'article 1', 
                'articleText' => 'this is the first article',
                'articleAuthor_id' => 1
            ],
            [
                'ArticleTitle' => 'article 2', 
                'articleText' => 'this is the second article',
                'articleAuthor_id' => 2
            ],
            [
                'ArticleTitle' => 'article 3', 
                'articleText' => 'this is the third article',
                'articleAuthor_id' => 3
            ],
            [
                'ArticleTitle' => 'article 4', 
                'articleText' => 'this is the fourth article',
                'articleAuthor_id' => 4
            ]
        ]);
    }
}
