@extends('layouts.app')
@section('titleName', 'Show Post Information')
@section('content')
    @if (session('success'))
        <div class="alert alert-info my-3 fs-3">
            {{ session('success') }}
        </div>
    @endif
    @if (session('failed'))
        <div class="alert alert-danger my-3 fs-3">
            {{ session('failed') }}
        </div>
    @endif
    <div class="container-fluid text-left ">
        <a href="{{ route('posts.index') }}" class="btn btn-primary">Back To Home</a>
    </div>
    <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
        <div class="card-header bg-primary text-white fs-2 font-weight-bold">Title: {{ $post->title }}</div>
        <div class="container_image" style="overflow: hidden; width:30%; margin:auto; border-radius: 50%">
            <img class="w-100" src="{{ asset('assets/images/posts/' . $post->image) }}" alt="UserImage">
        </div>
        <div class="card-body">
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">email: </span>
                {{ $post->user->email }}
            </p>
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">name: </span>
                {{ $post->user->name }}
            </p>
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">description: </span>
                {{ $post->description }}
            </p>
        </div>
    </div>
@endsection
