<?php

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

Route::get('admin/adminPermissions', function () {
    $users = User::all();

    return view('admin/adminPermissions', compact('users'));
});

Route::get('admin/adminTeachers', function () {
    $users = User::where('permission', 2)->get();

    return view('admin/adminTeachers', compact('users'));
});

Route::get('admin/adminStudents', function () {
    $users = User::where('permission', 3)->get();

    return view('admin/adminStudents', compact('users'));
});