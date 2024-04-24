@extends('layouts.app')
@section('title', 'Show User Information')
@section('content')
    @if (session('msg'))
        <div class="alert alert-info my-3">
            {{ session('msg') }}
        </div>
    @endif
    <div class="container-fluid text-left ">
        <a href="{{ route('users.index') }}" class="btn btn-primary">Back To Home</a>
    </div>
    <div class="card border-primary mb-3 mx-auto" style="max-width: 80rem;">
        <div class="card-header bg-primary text-white fs-2 font-weight-bold">Name: {{ $user->name }}</div>
        <div class="container_image" style="overflow: hidden; width:30%; margin:auto; border-radius: 50%">
            <img class="w-100" src="{{ asset('assets/images/users/' . $user->image) }}" alt="UserImage">
        </div>
        <div class="card-body">
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">email: </span>
                {{ $user->email }}
            </p>
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">phone: </span>
                {{ $user->phone }}
            </p>
            <p class="card-text fs-2"><span class="font-weight-bolder text-capitalize text-danger">gender: </span>
                {{ $user->gender }}
            </p>
        </div>
    </div>
@endsection
