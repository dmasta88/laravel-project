<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::factory(10)->create();
        $tags = Tag::all();
        $profile = Profile::first();
        foreach ($posts as $post) {
            $post->tags()->attach($tags->random(random_int(1, 20))->pluck('id'));
            $post->whoLiked()->attach($profile->pluck('id'));
            $post->whoViews()->attach($profile->pluck('id'));
        }
    }
}
