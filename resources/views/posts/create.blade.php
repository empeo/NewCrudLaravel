@extends('layouts.app')
@section('title',"Create New Post - Admin Panel")

@section('content')
    @if (session('failed'))
        <div class="alert alert-danger my-3 fs-3">
            {{ session('failed') }}
        </div>
    @endif
    <div class="container">
        <h2 class="my-5 text-center text-bold">Create a New Post</h2>
        <form class="row g-3" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                @error('title')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating">
                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                <label for="description">Description</label>
                @error('description')
                    <p class="fs-5 text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="user_share">What is the user's share</label>
                <select id="user_share" class="form-select" aria-label="Default select example" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label for="image" class="form-label text-capitalize">image</label>
                <input type="file" name="image" class="form-control" id="image">
                @error('image')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </form>
    @endsection
