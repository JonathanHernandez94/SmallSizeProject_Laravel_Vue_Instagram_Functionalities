<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = Auth::user()->following()->pluck('profiles.user_id');

        $latestPosts = Post::whereIn('user_id', $users)
                                ->with('user')
                                ->latest()
                                ->paginate(5);

        return view('posts.index',compact('latestPosts'));
    }


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => 'required|image',
        ]);

        $imagePath = $request['image']->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();


        Auth::user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/'. Auth::user()->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

}
