<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('admin/adminClasses', ["courses" => $courses]);
    }
}
