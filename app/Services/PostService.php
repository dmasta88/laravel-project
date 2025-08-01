<?php

namespace App\Services;

use Exception;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Str;
use App\Services\TagService;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Array_;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public static function store($data)
    {
        if (isset($data['post']['image_paths'])) {
            $image_paths = $data['post']['image_paths'];
            unset($data['images'], $data['post']['image_paths']);
        }
        try {
            DB::beginTransaction();
            $post = Post::create($data['post']);
            $tags = TagService::storeBatch($data['tags']);
            // foreach ($tags as $tag) {
            $post->tags()->attach($tags);
            //}
            $post->images()->createMany($image_paths);
            DB::commit();
            return $post;
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public static function update(Post $post, array $data): Post
    {
        unset($data['post']['images']);
        try {
            DB::beginTransaction();
            if (isset($data['post']['images_deleted'])) {
                foreach ($data['post']['images_deleted'] as $image) {
                    $relativePath = Str::after($image, '/storage/');
                    $imageForDelete = Image::where('image_path', $relativePath)->first();
                    Storage::disk('public')->delete($imageForDelete->image_path);
                    $imageForDelete->delete();
                }
                unset($data['post']['images_deleted']);
            }
            if (isset($data['post']['image_paths'])) {
                $imagePaths = $data['post']['image_paths'];
                $post->images()->createMany($imagePaths);
                unset($data['post']['image_paths']);
            }
            if (isset($data['tags'])) {
                $tags = [];
                foreach ($data['tags'] as $tag) {
                    $tags[] = Tag::firstOrCreate(['title' => $tag]);
                }
                unset($data['tags']);
                $post->tags()->sync($tags);
            }
            $post->update($data['post']);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        return $post;
    }
    public static function destroy(Post $post)
    {
        $cacheKey = "post:show:{$post->id}";
        Cache::forget($cacheKey);
        $post->tags()->detach();
        $image_paths = $post->images->image_path;
        dd($image_paths);
        Storage::delete();
        $post->images()->delete();
        $post->delete();
    }
}
