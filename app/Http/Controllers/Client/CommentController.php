<?php

namespace App\Http\Controllers\Client;

use Response;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Like\LikeResource;
use Illuminate\Http\Response as HttpResponse;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Requests\Client\Comment\IndexCommentRequest;
use App\Http\Requests\Client\Comment\ReplyCommentRequest;
use App\Jobs\Comment\CommentLikedJob;
use App\Mail\Comment\LikedCommentMail;
use Illuminate\Support\Facades\Response as FacadesResponse;

class CommentController extends Controller
{
    public function replyComment(Post $post, ReplyCommentRequest $request)
    {
        $data = $request->validated();
        $comment = $post->comments()->create($data);
        return CommentResource::make($comment)->resolve();
    }
    public function toggleLike(Comment $comment): array
    {
        if ($comment->whoLiked()->toggle(Auth::user()->profile->id)['attached']) {
            CommentLikedJob::dispatch($comment, Auth::user())->onQueue('emails');
            //Mail::to($comment->user)->send(new LikedCommentMail($comment, Auth::user()->profile));
        }
        return CommentResource::make($comment->fresh())->resolve();
    }
    public function children(Comment $comment, IndexCommentRequest $request)
    {
        $data = $request->validated();
        $children = $comment->children()->latest()->paginate($data['per_page'], '*', 'page', $data['page']);
        return CommentResource::collection($children);
    }
}
