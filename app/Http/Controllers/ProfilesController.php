<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $follows = Auth::user()->following->contains($user->id);

        $postCount = Cache::remember(
            'count.posts' . $user->id,
            now()->addSeconds(30),
            fn() => $user->posts->count()
        );

        $followersCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSeconds(30),
            fn() => $user->profile->followers->count()
        );

        $followingCount  = cache::remember(
            'count.following' . $user->id,
            now()->addSeconds(30),
            fn() => $user->following->count()
        );

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user->profile);

        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);


        if ($request['image']) {
            $imagePath = $request['image']->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        Auth::user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect('/profile/' . $user->id);
    }

}
