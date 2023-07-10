<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use App\Models\Inscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


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

// Read
Route::get('admin/adminPermissions', function () {
    $users = User::all();

    return view('admin/adminPermissions', compact('users'));
});

// Update
Route::post('admin/adminPermissions', [UserController::class, "update"])->name("userPermissions.update");

/* Admin Teachers Routes */

// Create
Route::post('admin/adminTeachers/create', [UserController::class, 'create'])->name('userTeachers.create');

// Read
Route::get('admin/adminTeachers', function () {
    $users = User::where('permission', 2)->get();
    $courses = Course::where('teacher', '')->orWhereNull('teacher')->get();

    return view('admin/adminTeachers', compact('users','courses'));
});

// Update
Route::post('admin/adminTeachers', [UserController::class, "update"])->name("userTeachers.update");

// Delete
Route::post('admin/adminTeachers/delete', [UserController::class, "delete"])->name("userTeachers.delete");

/* Admin Students Routes */

// Create
Route::post('admin/adminStudents/create', [UserController::class, "create"])->name("userStudents.create");

// Read
Route::get('admin/adminStudents', function () {
    $users = User::where('permission', 3)->get();

    return view('admin/adminStudents', compact('users'));
});

// Update
Route::post('admin/adminStudents', [UserController::class, "update"])->name("userStudents.update");

// Delete
Route::post('admin/adminStudents/delete', [UserController::class, "delete"])->name("userStudents.delete");

/* Admin Classes Routes */

// Create
Route::post('admin/adminClasses/create', [CourseController::class, "create"])->name("course.create");

// Read
Route::get('admin/adminClasses', function () {
    $courses = Course::all();
    $users = User::where('permission', 2)->where(function ($query) {
        $query->where('class', '')->orWhereNull('class');
    })->get();

    return view('admin/adminClasses', compact('courses','users'));
});

// Update
Route::post('admin/adminClasses', [CourseController::class, "update"])->name("course.update");

// Delete
Route::post('admin/adminClasses/delete', [CourseController::class, "delete"])->name("course.delete");

/* Student Classes Routes */

// Create
Route::post('student/studentClasses/create', [InscriptionController::class, "create"])->name("inscription.create");

// Read
Route::get('student/studentClasses', function() {
    $courses = Course::whereNotExists(function ($query) {
        $query->select(DB::raw(1))
            ->from('Inscriptions')
            ->whereRaw('Courses.class = Inscriptions.class')
            ->where('Inscriptions.studentID', Auth::user()->id);
    })->get();

    $inscriptions = Inscription::where('studentID', Auth::user()->id)->get();

    return view('student/studentClasses', compact('courses', 'inscriptions'));
});

// Delete
Route::post('student/studentClasses/delete', [InscriptionController::class, "delete"])->name("inscription.delete");