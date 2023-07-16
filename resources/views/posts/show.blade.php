@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div>
                        <img src="/storage/{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 50px">
                    </div>
                    <div style="padding-left: 5px">
                        <strong><a href="{{ route('profile.show', $post->user) }}">{{ $post->user->username }}</a></strong>
                    </div>
                    <a href="#" style="padding-left: 5px">Follow</a>
                </div>
                <hr>

                <p><span><strong style="padding-right: 3px"><a href="{{ route('profile.show', $post->user) }}">{{ $post->user->username }}</a></strong></span>{{ $post->caption }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
