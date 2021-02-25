<?php
namespace App\Repositories\Post;

use App\Repositories\BaseRepository;
use App\Models\Post;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    public function getPostLatest($id)
    {
        return Post::with('images')
            ->where('user_id', $id )
            ->withCount('users', 'comments')
            ->latest('created_at')
            ->get();
    }

    public function getPostWhereIdExists($id)
    {
        return Post::where('id', $id)->exists();
    }

    public function getPosts($id){
        return Post::with('user', 'images', 'comments')
            ->withCount('users')
            ->where('id', $id)->get();
    }

    public function getPostWithUserImageCommentLatest($colunm , $value)
    {
        return Post::with('user', 'images', 'comments')
            ->where($colunm, $value )
            ->withCount('users', 'comments')
            ->latest('created_at')
            ->get();
    }

    public function getPostLimit($user)
    {
        return Post::with(["user", "images", "comments" => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])
            ->whereIn('user_id', $user)
            ->withCount('users', 'comments')
            ->orderBy('created_at', 'desc')
            ->limit(config('var_in_controller.take_record_3'))
            ->get();
    }

    public function getPostLoadMore($user, $id)
    {
        return Post::with("user", "images", "comments")
            ->whereIn('user_id', $user)
            ->where('id', '<' , $id)
            ->withCount('users', 'comments')
            ->orderBy('created_at', 'desc')
            ->limit(config('var_in_controller.take_record_3'))
            ->get();
    }

    public function findPostWithUser($id)
    {
        return Post::with('user')->findOrFail($id);
    }

    public function getCommentLoadMore($id, $commentId)
    {
        return Post::with(['user', 'images', 'comments' => function ($query) use ($commentId) { 
            $query->where('id', '<', $commentId)->limit(config('var_in_controller.limit_record'))->orderBy('created_at', 'desc'); 
        }])->where('id', $id)->withCount('users', 'comments')->orderBy('created_at', 'desc')->get();
    }
}
