<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view("users.index", compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("users.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $requestData = $request->except('conpassword');
        $request['password'] = Hash::make($request->password);
        if (!is_dir(public_path("assets/images/users"))) {
            mkdir(public_path("assets/images/users"));
        }
        $image = $request->file('image');
        $imageNameDB = time() . $image->getClientOriginalName();
        $requestData['image'] = $imageNameDB;
        $imageStore = $image->move("assets/images/users/", $imageNameDB);
        if ($imageStore) {
            User::create($requestData);
            return redirect()->route('users.index')->with('success', 'User created successfully');
        }
        return redirect()->route('users.create')->with('failed', 'User Not Created Correctly');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return view("users.show", ["user" => $user]);
        }
        return redirect()->route("users.index")->with('failed', 'User Not Founded');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return view("users.edit", ["user" => $user]);
        }
        return redirect()->route("users.index")->with('failed', 'User Not Founded');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        $user = User::find($id);
        $requestData = $request->except(['conpassword']);
        if ($request->hasFile('image')) {
            $imagePath = public_path("assets/images/users/{$user->image}");
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image = $request->file('image');
            $imageNameDB = time() . $image->getClientOriginalName();
            $requestData['image'] = $imageNameDB;
            $image->move("assets/images/users/", $imageNameDB);
        }

        $requestData['password'] = Hash::make($request->password);

        $user->update($requestData);

        return redirect()->route('users.show', ["user" => $user])->with('success', 'User Updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route("users.index")->with('failed', 'User Not Found');
        }
        if ($user->image !== null) {
            $image = public_path("assets/images/users/{$user->image}");
            if (file_exists($image)) {
                unlink($image);
            }
        }
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
    public function clear()
    {
        function deleteImages(string $path, array $image)
        {
            foreach ($image as $value) {
                if(file_exists(public_path($path.$value)))
                    unlink(public_path($path . $value));
            }
        }
        $pathImages = "assets/images/users/";
        $images = User::all()->pluck('image')->toArray();
        deleteImages($pathImages, $images);
        User::query()->delete();
        return redirect()->route('users.index')->with('success', 'All Users deleted successfully');
    }
}
