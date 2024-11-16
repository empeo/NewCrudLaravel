<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>
About This Project
This Laravel project demonstrates the implementation of CRUD (Create, Read, Update, Delete) operations for managing users and posts. Additionally, custom routes are provided to clear all entries in these resources.

Routes Overview
Below is an overview of the routes included in this project:

Home Page
URL: /
Method: GET
Description: Displays the welcome page of the application.
Named Route: welcomePage
php
Copy code
Route::get('/', function () {
    return view('welcome');
})->name("welcomePage");
User Management (CRUD)
Base Resource URL: /users
Controller: UserController
Action	Method	URL	Controller Method	Named Route
Create Form	GET	/users/create	create	-
List All Users	GET	/users	index	-
View User Details	GET	/users/{user}	show	-
Edit Form	GET	/users/{user}/edit	edit	-
Update User	PUT/PATCH	/users/{user}	update	-
Delete User	DELETE	/users/{user}	destroy	-
Clear All Users	DELETE	/users	clear	users.clear
php
Copy code
Route::resource("users", UserController::class);
Route::delete("users", [UserController::class, "clear"])->name("users.clear");
Post Management (CRUD)
Base Resource URL: /posts
Controller: PostController
Action	Method	URL	Controller Method	Named Route
Create Form	GET	/posts/create	create	-
List All Posts	GET	/posts	index	-
View Post Details	GET	/posts/{post}	show	-
Edit Form	GET	/posts/{post}/edit	edit	-
Update Post	PUT/PATCH	/posts/{post}	update	-
Delete Post	DELETE	/posts/{post}	destroy	-
Clear All Posts	DELETE	/posts	clear	posts.clear
php
Copy code
Route::resource("posts", PostController::class);
Route::delete("posts", [PostController::class, "clear"])->name("posts.clear");
