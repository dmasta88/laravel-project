<div>
    <h1>New comment</h1>
    <p>Your post: {{ $post->id }} has been commented by: {{ $comment->profile->login }}</p>
    <p>Comment: {{ $comment->content }}</p>
</div>
