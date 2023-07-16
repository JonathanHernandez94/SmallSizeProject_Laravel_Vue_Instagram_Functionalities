@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">

                <div class=" row">
                    <h1>Add New Post</h1>
                </div>

                <div class="row mb-3">
                    <label for="caption" class="col-md-4 col-form-label">{{ __('Post Caption') }}</label>

                    <input id="caption"
                        type="text"
                        class="form-control @error('caption') is-invalid @enderror"
                        name="caption"
                        value="{{ old('caption') }}"
                        autocomplete="caption" autofocus>

                    @error('caption')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>

                <div class="row">
                    <label for="image" class="col-md-4 col-form-label">{{ __('Post Image') }}</label>
                    <input id="image" type="file" class="form-control-file" name="image">

                    @error('image')
                    <span class="is-invalid" style="color: red">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                </div>
                <div class="row pt-5">
                    <button class="btn btn-primary" type="submit" style="width: 135px; height: 35px;" >Add New Post</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection
