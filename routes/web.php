<?php

use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Admin Permissions Routes */

//Read
Route::get('admin/adminPermissions', function () {
    $users = User::all();

    return view('admin/adminPermissions', compact('users'));
});

//Update
Route::post('admin/adminPermissions', [UserController::class, "update"])->name("userPermissions.update");

//Delete
//Route::get('/modificar-producto-{id}', [CrudCrontoller::class, "delete"])->name("crud.delete");

/* Admin Teachers Routes */

// Read
Route::get('admin/adminTeachers', function () {
    $users = User::where('permission', 2)->get();
    $courses = Course::where('teacher', '')->orWhereNull('teacher')->get();

    return view('admin/adminTeachers', compact('users','courses'));
});

//Update
Route::post('admin/adminTeachers', [UserController::class, "update"])->name("userTeachers.update");

/* Admin Students Routes */

// Read
Route::get('admin/adminStudents', function () {
    $users = User::where('permission', 3)->get();

    return view('admin/adminStudents', compact('users'));
});

//Update
Route::post('admin/adminStudents', [UserController::class, "update"])->name("userStudents.update");

/* Admin Classes Routes */

// Read
Route::get('admin/adminClasses', function () {
    $courses = Course::all();

    return view('admin/adminClasses', compact('courses'));
});