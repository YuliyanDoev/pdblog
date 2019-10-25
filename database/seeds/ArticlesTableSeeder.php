<?php

use App\Models\Article;
use App\Models\Comment;
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
        factory(Article::class, 20)->create()->each(function($article){
            $article->comments()->save(factory(Comment::class)->make());
            $article->tags()->attach(range(1,rand(1,7)));
        });
    }
}
