@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" method="post">
        @csrf
        @method('patch')

        <div class="row">
            <div class="col-8 offset-2">

                <div class=" row">
                    <h1>Edit Profile</h1>
                </div>

                <div class="row mb-3">
                    <label for="title" class="col-md-4 col-form-label">{{ __('Title') }}</label>

                    <input id="title"
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        name="title"
                        value="{{ old('title') ?? $user->profile->title}}"
                        autocomplete="title" autofocus>

                    @error('title')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="description" class="col-md-4 col-form-label">{{ __('Description') }}</label>
                    <input id="description" type="text"  value="{{ old('description') ?? $user->profile->description}}"
                    class="form-control @error('title') is-invalid @enderror" name="description">

                    @error('description')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="url" class="col-md-4 col-form-label">{{ __('URL') }}</label>
                    <input id="url" type="text" value="{{ old('url') ?? $user->profile->url}}"
                    class="form-control @error('title') is-invalid @enderror" name="url">

                    @error('url')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">{{ __('Profile Image') }}</label>
                    <input id="image"
                    type="file" class="form-control-file" name="image">

                    @error('image')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>


                <div class="row pt-5">
                    <button class="btn btn-primary" type="submit" style="width: 135px; height: 35px;" >Save Profile</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
