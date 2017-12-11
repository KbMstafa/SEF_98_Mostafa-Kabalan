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
                'article_title' => 'article 1', 
                'article_text' => 'this is the first article',
                'article_author_id' => 1
            ],
            [
                'article_title' => 'article 2', 
                'article_text' => 'this is the second article',
                'article_author_id' => 2
            ],
            [
                'article_title' => 'article 3', 
                'article_text' => 'this is the third article',
                'article_author_id' => 3
            ],
            [
                'article_title' => 'article 4', 
                'article_text' => 'this is the fourth article',
                'article_author_id' => 4
            ]
        ]);
    }
}
