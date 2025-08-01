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
use App\Models\Statistics;

class StatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Output statistics';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commentsCount = Comment::count();
        $likesCount = DB::table('likeables')->where('likeable_type', Post::class)->count();
        $viewsCount = DB::table('post_profile_views')->count();
        $likesViews = $likesCount / $viewsCount;
        $likesComments = $likesCount / $commentsCount;
        $data = [
            'comments_count' => $commentsCount,
            'likes_count' => $likesCount,
            'views_count' => $viewsCount,
            'likes_views' =>  $likesViews,
            'likes_comments' => $likesComments,
            'posts_count' => Post::count(),
            'date' => now(),
        ];
        Statistics::create($data);
    }
}
