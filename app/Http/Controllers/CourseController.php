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
        //dd($request->all());
        //Sin Maestro -> Sin Maestro
        if ($request->adminClassesTeacher === NULL && $request->adminClassesOldTeacher === NULL) {
            try {
                $teacherID = NULL;
                $teacher = NULL;
                $query = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                $bindings = [
                    $request->adminClassesClass,
                    $teacherID,
                    $teacher,
                    $request->adminClassesID,
                ];
                $sql = DB::update($query, $bindings);

                // Verificar el valor de $sql
                //dd($sql);

                if ($sql == 0) {
                    $sql = 1;
                }
            } catch (\Throwable $th) {
                // Verificar el error
                //dd($th);
                $sql = 0;
            }

            if ($sql == true) {
                return back()->with("Correct", "Information Updated");
            } else {
                return back()->with("Incorrect", "Error");
            }
            //Nuevo Maestro -> Sin Maestro
            
        } else if ($request->adminClassesTeacher != NULL && $request->adminClassesOldTeacher === NULL) {
            try{
                $teacherInfo = explode(",", $request->adminClassesTeacher);
                $teacherID = $teacherInfo[0];
                $teacher = $teacherInfo[1];
                $query = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                $queryUsers = "UPDATE users SET class=? WHERE id=?";
                $bindings = [
                    $request->adminClassesClass,
                    $teacherID,
                    $teacher,
                    $request->adminClassesID,
                ];
                $bindingsUsers = [
                    $request->adminClassesClass,
                    $teacherID,
                ];

                $sql = DB::update($query, $bindings);
                $sqlUsers = DB::update($queryUsers, $bindingsUsers);

                // Verificar el valor de $sql
                //dd($sql);
                //dd($sqlUsers);

                if ($sql == 0 && $sqlUsers) {
                    $sql = 1;
                    $sqlUsers = 1;
                }

            } catch (\Throwable $th) {
                // Verificar el error
                //dd($th);
                $sql = 0;
                $sqlUsers = 0;
            }

            if ($sql == true && $sqlUsers == true) {
                return back()->with("Correct", "Information Updated");
            } else {
                return back()->with("Incorrect", "Error");
            }
            //Nuevo Maestro -> Viejo Maestro
        } else if ($request->adminClassesTeacher != NULL && $request->adminClassesOldTeacher != NULL) {
            if ($request->adminClassesTeacher == $request->adminClassesOldTeacher) {
                try {
                    $teacherInfo = explode(",", $request->adminClassesTeacher);
                    $teacherID = $teacherInfo[0];
                    $teacher = $teacherInfo[1];
                    $query = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                    $queryUsers = "UPDATE users SET class=? WHERE id=?";
                    $bindings = [
                        $request->adminClassesClass,
                        $teacherID,
                        $teacher,
                        $request->adminClassesID,
                    ];
                    $bindingsUsers = [
                        $request->adminClassesClass,
                        $teacherID,
                    ];

                    $sql = DB::update($query, $bindings);
                    $sqlUsers = DB::update($queryUsers, $bindingsUsers);

                    // Verificar el valor de $sql
                    //dd($sql);
                    //dd($sqlUsers);

                    if ($sql == 0 && $sqlUsers) {
                        $sql = 1;
                        $sqlUsers = 1;
                    }
                } catch (\Throwable $th) {
                    // Verificar el error
                    //dd($th);
                    $sql = 0;
                    $sqlUsers = 0;
                }

                if ($sql == true && $sqlUsers == true) {
                    return back()->with("Correct", "Information Updated");
                } else {
                    return back()->with("Incorrect", "Error");
                }
            } else {
                try{
                    $oldTeacherInfo = explode(",", $request->adminClassesOldTeacher);
                    $oldTeacherID = $oldTeacherInfo[0];
                    $oldTeacherClass = NULL;
                    $teacherInfo = explode(",", $request->adminClassesTeacher);
                    $teacherID = $teacherInfo[0];
                    $teacher = $teacherInfo[1];
                    $query = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                    $queryUsers = "UPDATE users SET class=? WHERE id=?";
                    $queryOldUsers = "UPDATE users SET class=? WHERE id=?";
                    $bindings = [
                        $request->adminClassesClass,
                        $teacherID,
                        $teacher,
                        $request->adminClassesID,
                    ];
                    $bindingsUsers = [
                        $request->adminClassesClass,
                        $teacherID,
                    ];
                    $bindingsOldUsers = [
                        $oldTeacherClass,
                        $oldTeacherID,
                    ];

                    $sql = DB::update($query, $bindings);
                    $sqlUsers = DB::update($queryUsers, $bindingsUsers);
                    $sqlOldUsers = DB::update($queryOldUsers, $bindingsOldUsers);

                    // Verificar el valor de $sql
                    //dd($sql);
                    //dd($sqlUsers);
                    //dd($sqlOldUsers);

                    if ($sql == 0 && $sqlUsers && $sqlOldUsers) {
                        $sql = 1;
                        $sqlUsers = 1;
                        $sqlOldUsers = 1;
                    }
                } catch (\Throwable $th) {
                    // Verificar el error
                    //dd($th);
                    $sql = 0;
                    $sqlUsers = 0;
                    $sqlOldUsers = 0;
                }

                if ($sql == true && $sqlUsers == true && $sqlOldUsers == true) {
                    return back()->with("Correct", "Information Updated");
                } else {
                    return back()->with("Incorrect", "Error");
                }
            }
            //Sin Maestro -> Viejo Maestro
        } else if ($request->adminClassesTeacher === NULL && $request->adminClassesOldTeacher != NULL) {
            try {
                $oldTeacherInfo = explode(",", $request->adminClassesOldTeacher);
                $oldTeacherID = $oldTeacherInfo[0];
                $teacherID = NULL;
                $teacher = NULL;
                $class = NULL;
                $query = "UPDATE courses SET class=?, teacherID=?, teacher=? WHERE id=?";
                $queryUsers = "UPDATE users SET class=? WHERE id=?";
                $bindings = [
                    $request->adminClassesClass,
                    $teacherID,
                    $teacher,
                    $request->adminClassesID,
                ];
                $bindingsUsers = [
                    $class,
                    $oldTeacherID,
                ];

                $sql = DB::update($query, $bindings);
                $sqlUsers = DB::update($queryUsers, $bindingsUsers);

                // Verificar el valor de $sql
                //dd($sql);
                //dd($sqlUsers);

                if ($sql == 0 && $sqlUsers) {
                    $sql = 1;
                    $sqlUsers = 1;
                }
            } catch (\Throwable $th) {
                // Verificar el error
                //dd($th);
                $sql = 0;
                $sqlUsers = 0;
            }

            if ($sql == true && $sqlUsers == true) {
                return back()->with("Correct", "Information Updated");
            } else {
                return back()->with("Incorrect", "Error");
            }
        }
    }
}
