<?php

namespace App\Http\Controllers\Client;

use Exception;
use App\Models\Post;
use App\Models\Comment;
use App\Services\PostService;
use Illuminate\Http\Response;
use App\Jobs\Post\PostLikedJob;
use App\Mail\Post\LikedPostMail;
use Illuminate\Support\Facades\DB;
use App\Events\Post\PostLikedEvent;
use App\Jobs\Post\PostCommentedJob;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Jobs\Comment\CommentRepliedJob;
use App\Mail\Comment\StoredCommentMail;
use App\Mail\Comment\RepliedCommentMail;
use App\Http\Resources\Post\PostResource;
use App\Http\Requests\Post\IndexPostRequest;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Client\Post\RepostPostRequest;
use App\Http\Requests\Client\Post\StoreCommentRequest;
use App\Http\Requests\Client\Comment\IndexCommentRequest;

class PostController extends Controller
{
    public function index(IndexPostRequest $request)
    {
        $posts = PostResource::collection(Auth::user()->profile->posts()->with('parent')->get())->resolve();
        return inertia('Client/Dashboard/Index', compact('posts'));
    }
    public function show(Post $post)
    {
        //$comments = CommentResource::collection($post->comments()->paginate(5));
        $post = PostResource::make($post)->resolve();
        return inertia('Client/Post/Show', compact('post'));
    }
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        $post->delete();
        return response()->json(['message' => 'Post deleted']);
    }
    public function repost(RepostPostRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $post = Post::create($data['post']);
            DB::commit();
            return PostResource::make($post)->resolve();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function storeComment(Post $post, StoreCommentRequest $request)
    {
        $data = $request->validated();
        $comment = $post->comments()->create($data);
        if ($data['parent_id']) {
            $parentComment = Comment::where(['id' => $data['parent_id']])->first();
            CommentRepliedJob::dispatch($comment, $parentComment, Auth::user())->onQueue('emails');
            //Mail::to($parentComment->user->email)->send(new RepliedCommentMail($comment, $parentComment, Auth::user()->profile));
        } else {
            PostCommentedJob::dispatch($post, $comment)->onQueue('emails');
            //Mail::to($post->user)->send(new StoredCommentMail($post, $comment));
        }
        return CommentResource::make($comment->fresh());
    }
    public function indexComments(Post $post, IndexCommentRequest $request)
    {
        $data = $request->validated();
        $comments = $post->comments()->whereNull('parent_id')->withCount('children')->paginate($data['per_page'], '*', 'page', $data['page']);
        return CommentResource::collection($comments);
    }
    public function toggleLike(Post $post)
    {
        if ($post->whoLiked()->toggle(Auth::user()->profile->id)['attached']) {
            PostLikedEvent::dispatch($post, Auth::user());
            //PostLikedJob::dispatch($post, Auth::user())->onQueue('emails');
            // Mail::to($post->user)->send(new LikedPostMail($post, Auth::user()));
        }
        return PostResource::make($post->fresh())->resolve();
        //return response(['is_liked' => count($res['attached']) > 0]);
    }
}
