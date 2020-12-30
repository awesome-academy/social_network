<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with("user", "images", "comments")->withCount('users')->orderBy('created_at', 'desc')->get();
        
        foreach ($posts as $post) {
            $post->status = Post::UNLIKED;
            if (DB::table('likes')->where([['user_id', Auth::user()->id], ['post_id', $post->id]])->exists()) {
                $post->status = Post::LIKED;
            }
        }
        
        return view('time_line', compact('posts'));
    }
}
