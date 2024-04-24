@extends('layouts.app')
@section('title', 'Post - Admin Panel')
@section('content')
    @if ($users->isNotEmpty())
        <div class="text-center my-4">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create A Post</a>
        </div>
        @if (session('success'))
            <div class="alert alert-info">
                {{ session('success') }}
            </div>
        @endif
        @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
        @if ($posts->isNotEmpty())
            <table class="table text-center table-responsive" id="myTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-capitalize">ID</th>
                        <th scope="col" class="text-capitalize">Title</th>
                        <th scope="col" class="text-capitalize">user name</th>
                        <th scope="col" class="text-capitalize">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this post?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-content-center">
                {{ $posts->links() }}
            </div>
            <div class="text-center my-4">
                <form action="{{ route('posts.clear') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete All Posts?')">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete All Posts</button>
                </form>
            </div>
        @else
            <div class="alert alert-info text-center" role="alert">
                Not Have A Post Create A One
            </div>
        @endif
    @else
        <div class="alert alert-info text-center" role="alert">
            Not Have a User Return Back To Users Page Create A User
        </div>
    @endif
@endsection
