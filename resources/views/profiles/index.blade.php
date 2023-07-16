@extends('layouts.app')

@section('content')
<div id="app" class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle" style="width: 200px; height: 200px;">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex">
                    <div class="h4" style="padding-right: 10px">{{ $user->username }}</div>
                        <follow-button :user-id="{{ $user->id }}" :follows="{{  $follows }}"></follow-button>
                </div>

                @can('update', $user->profile)
                <a href="{{ route('post.create') }}">Add new post</a>
                @endcan
            </div>
            @can('update', $user->profile)
            <a href="{{ route('profile.edit', $user) }}">Edit Profile2</a>
            @endcan

            <div class="d-flex">
                <div style="padding-right: 19px"><strong>{{ $postCount }}</strong> posts</div>
                <div style="padding-right: 19px"><strong>{{ $followersCount }}</strong> followers</div>
                <div style="padding-right: 19px"><strong>{{ $followingCount }}</strong> following</div>
            </div>

            <div class="pt-4 font-weight-bold"><strong>{{ $user->profile->title }}</strong></div>

            <div>{{ $user->profile->description }}</div>

            <div><a href={{ $user->profile->url }}>{{ $user->profile->url }}</a></div>

        </div>
    </div>

    <div class="row pt-5">
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="{{ route('post.show', $post->id) }}">
                <img src="{{ asset('storage/' . $post->image) }}" class="w-100 h-100" alt="">
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection
