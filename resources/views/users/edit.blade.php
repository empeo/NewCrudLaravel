@extends('layouts.app')
@section('title', 'Edit User - Admin Panel')
@section('content')
    @if (session('failed'))
        <div class="alert alert-danger">
            {{ session('failed') }}
        </div>
    @endif
    <div class="container">
        <h2 class="my-5 text-center text-bold">Edit This User</h2>
        <form class="row g-3" method="post" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-12">
                <label for="name" class="form-label text-capitalize">name</label>
                <input type="text" name="name" class="form-control" id="name"
                    value="{{ old('name') ? old('name') : $user->name }}">
                @error('name')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <label for="email" class="form-label text-capitalize">email</label>
                <input type="text" name="email" class="form-control" id="email"
                    value="{{ old('email') ? old('email') : $user->email }}">
                @error('email')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <label for="password" class="form-label text-capitalize">password</label>
                <input type="password" name="password" class="form-control" id="password">
                @error('password')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="conpassword" class="form-label">Confirm Password</label>
                <input type="password" name="conpassword" class="form-control" id="conpassword">
                @error('conpassword')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone"
                    value="{{ old('phone') ? old('phone') : $user->phone }}">
                @error('phone')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="male" name="gender" value="male"
                    @checked(old('gender') == 'male')>
                <label class="form-check-label text-capitalize" for="male">
                    male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="female" name="gender" value="female"
                    @checked(old('gender') == 'female')>
                <label class="form-check-label text-capitalize" for="female">
                    female
                </label>
            </div>
            @error('gender')
                <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
            @enderror
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
