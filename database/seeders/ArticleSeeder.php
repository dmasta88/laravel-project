<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::factory(10)->create();
        $profile = Profile::first();
        foreach ($articles as $article) {
            $article->whoLiked()->attach($profile);
        }
    }
}
