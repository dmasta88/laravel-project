<?php

namespace App\Console\Commands;

use App\Models\Tag;
use App\Models\Chat;
use App\Models\Like;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Console\Command;
use App\Events\Log\StartLogEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Events\Post\StoredPostEvent;
use App\Models\ProfileNotification;

class GoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        for ($i = 1; $i <= 10; $i++) {
            ProfileNotification::create(['profile_id' => 1, 'content' => 'Random Notification ' . $i]);
        }

        // $events = $user->logEvents;
        // foreach ($events as $event) {
        //     dump($event);
        // }
        //dd($posts);
        //$post = Post::find(1);
        //Log::channel('post')->info('post created {post}', ['post' => $post->id]);
        // $post = Post::find(2);

        // StoredPostEvent::dispatch($post);
        // $post = Post::withTrashed()->find(6);

        // $post->restore();

        // dump($post->id);
        // dd($post->comments->pluck('id'));


        // $tag = Tag::first();
        // dd($tag->posts);
        // // $post = Post::first();
        // dd($post->profile);

        //$category = Category::find(3);
        // $comment = Comment::find(1);
        // dd($comment->tags->pluck('id'));

        //$post = Post::first();
        // $image = Image::first();
        // dd($image->imageable);

        // $comment = Comment::first();
        // dump($comment->content);
        // dd($comment->commentable->title);

        // $post->image()->create(
        //     [
        //         "image_url" => fake()->imageUrl()
        //     ]
        // );

        //dd($category->comment);

        // $profile = Profile::first();
        // dump($profile->likedPosts->pluck('id'));
        // dd($profile->likedArticles->pluck('id'));

        // dd($profile->user);
        // // //dump($profile->likedPosts);
        // // //dump($profile->repostedPosts);
        // dump($profile->messages);

        // $role = Role::first();
        // dd($role->users);

        // $post = Post::first();
        // dump($post->whoLiked);


        // $comment = Comment::first();
        // if ($comment) {
        //     dump($comment->profile);
        //     dump($comment->post);
        // } else {
        //     echo 'Нет комменатриев';
        // }
    }
}
