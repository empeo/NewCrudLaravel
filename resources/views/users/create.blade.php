@extends('layouts.app')
@section('title', 'Create New User - Admin Panel')
@section('content')
    <div class="container">
        @if (session('failed'))
            <p class="alert alert-danger">failed</p>
        @endif
        <h2 class="my-5 text-center text-bold">Create a New User</h2>
        <form class="row g-3" method="post" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-12">
                <label for="name" class="form-label">name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
                @error('name')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
                @error('email')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
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
            <div class="col-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
                @error('phone')
                    <p class="fs-5 text-danger text-capitalize">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="flexRadioDefault1" name="gender" value="male"
                    @checked(old('gender') == 'male')>
                <label class="form-check-label text-capitalize" for="flexRadioDefault1">
                    male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="flexRadioDefault2" name="gender" value="female"
                    @checked(old('gender') == 'female')>
                <label class="form-check-label text-capitalize" for="flexRadioDefault2">
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
