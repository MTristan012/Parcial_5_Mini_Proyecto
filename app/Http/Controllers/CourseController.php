<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();

        return view('admin/adminClasses', ["courses" => $courses]);
    }
    public function update(Request $request)
    {
        // Verificar los valores de las variables
        dd($request->all());
        /*
        try {
            if ($request->adminClassesTeacher === NULL) {
                $teacherID = NULL;
                $teacher = NULL;
                $queryCourses = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                $bindingsCourses = [
                    $request->adminClassesClass,
                    $teacherID,
                    $teacher,
                    $request->adminClassesID,
                ];
            } else {
                $adminTeacherInfo = explode(",", $request->adminClassesTeacher);
                $adminTeacherID = $adminTeacherInfo[0];
                $adminTeacher = $adminTeacherInfo[1];
                $queryCourses = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                $bindingsCourses = [
                    $request->adminClassesClass,
                    $adminTeacherID,
                    $adminTeacher,
                    $request->adminClassesID,
                ];
            }

            if ($request->adminClassesOldTeacher != NULL && $request->adminClassesTeacher === NULL) {
                $userInfo = explode(",", $request->adminClassesOldTeacher);
                $userID = $userInfo[0];
                $userClass = NULL;
                $query = "UPDATE users SET class=?, WHERE id=?";
                $bindings = [
                    $userClass,
                    $userID,
                ];
            } else if ($request->adminClassesOldTeacher != NULL && $request->adminClassesTeacher != NULL && $request->adminClassesOldTeacher != $request->adminClassesTeacher){
                $userInfo = explode(",", $request->adminClassesOldTeacher);
                $userID = $userInfo[0];
                $userClass = NULL;
                $userNewInfo = explode(",", $request->adminClassesTeacher);
                $userNewID = $userNewInfo[0];
                $userNewClass = $request->adminClassesClass;
                $query = "UPDATE users SET class=?, WHERE id=?";
                $bindings = [
                    $userClass,
                    $userID,
                ];
                $queryNew = "UPDATE users SET class=?, WHERE id=?";
                $bindingsNew = [
                    $userNewClass,
                    $userNewID,
                ];
            }

            
            $sql = DB::update($query, $bindings);
            $sqlCourses = DB::update($queryCourses, $bindingsCourses);

            // Verificar el valor de $sql
            //dd($sql);
            //dd($sqlCourses);

            if ($sql == 0 && $sqlCourses == 0) {
                $sql = 1;
                $sqlCourses = 1;
            }
        } catch (\Throwable $th) {
            // Verificar el error
            //dd($th);
            $sql = 0;
            $sqlCourses = 1;
        }

        if ($sql == true && $sqlCourses == true) {
            return back()->with("Correct", "Information Updated");
        } else {
            return back()->with("Incorrect", "Error");
        }
        */
    }
}
