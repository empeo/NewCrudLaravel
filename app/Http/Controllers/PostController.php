<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $posts = Post::paginate(10);
        return view("posts.index", ["posts" => $posts, "users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("posts.create", ["users" => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required|min:5",
            "description" => "required|min:20",
            "user_id" => "required",
            'image' => 'required|mimes:jpg,jpeg,png|max:1024',
        ]);
        if (!is_dir(public_path("assets/images/posts"))) {
            mkdir(public_path("assets/images/posts"));
        }
        $requestDB = $request->all();
        $image = $request->file('image');
        $imageNameDB = time() . $image->getClientOriginalName();
        $requestDB['image'] = $imageNameDB;
        $imageStore = $image->move("assets/images/posts/", $imageNameDB);
        if ($imageStore) {
            Post::create($requestDB);
            return redirect()->route('posts.index')->with('success', 'Post created successfully');
        }
        return redirect()->route('posts.create')->with('failed', 'Post Not Created Correctly');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            return view("posts.show", ["post" => $post]);
        }
        return redirect()->route("posts.index")->with('failed', 'post Not Founded');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::find($id);
        $user = User::all();
        if ($post) {
            return view("posts.edit", ["post" => $post, "users" => $user]);
        }
        return redirect()->route("posts.index")->with('failed', 'post Not Founded');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required|min:5",
            "description" => "required|min:20",
            "user_id" => "required",
            'image' => 'mimes:jpg,jpeg,png|max:1024',
        ]);
        $post = Post::find($id);
        $requestDB = $request->all();
        if ($request->hasFile("image")) {
            $image_path = public_path("assets/images/posts/" . $post->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $image = $request->file('image');
            $imageNameDB = time() . $image->getClientOriginalName();
            $requestDB['image'] = $imageNameDB;
            $image->move("assets/images/posts/", $imageNameDB);
        }

        $result = $post->update($requestDB);
        if ($result) {
            return redirect()->route('posts.index')->with('success', 'Post Edited successfully');
        }
        return redirect()->route('posts.index')->with('failed', 'Post not Edited');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if ($post) {
            $image_path = public_path("assets/images/posts/" . $post->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $post->delete();
            return redirect()->route("posts.index")->with('success', 'post Deleted Successfully');
        }
        return redirect()->route("posts.index")->with('failed', 'post Not Founded');
    }
    public function clear()
    {
        function deleteImages(string $path, array $images)
        {
            foreach ($images as $image) {
                $image_path = public_path($path . $image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }
        $images = Post::all()->pluck("image")->toArray();
        $path = "assets/images/posts/";
        deleteImages($path, $images);
        Post::query()->delete();
        return redirect()->route("posts.index")->with('success', 'All Posts Deleted Successfully');
    }
}
