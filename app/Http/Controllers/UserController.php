<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin/adminPermissions', ["users" => $users]);
    }
    public function create(Request $request)
    {
        // Verificar los valores de las variables
        //dd($request->all()); 
        if ($request->has('adminNewTeacherAccept')) {
            $user = new User();
            $user->email = $request->input('adminNewTeacherEmail');
            $user->name = $request->input('adminNewTeacherName');
            $user->address = $request->input('adminNewTeacherAddress');
            $user->birthday = $request->input('adminNewTeacherBirthday');
            $user->password = "teacher1";
            $user->permission = "2";

            if (
                $user->email !== null && $user->email !== '' &&
                $user->name !== null && $user->name !== '' &&
                $user->address !== null && $user->address !== '' &&
                $user->birthday !== null && $user->birthday !== ''
            ) {
                try {
                    $user->save();
                    return back()->with("Correct", "Teacher added successfully");
                } catch (\Throwable $th) {
                    return back()->with("Incorrect", "Error");
                }
            } else {
                return back()->with("Incorrect", "Please fill in all the required fields");
            }
        }else if($request->has('adminNewStudentAccept')){
            $user = new User();
            $user->dni = $request->input('adminNewStudentDNI');
            $user->email = $request->input('adminNewStudentEmail');
            $user->name = $request->input('adminNewStudentName');
            $user->address = $request->input('adminNewStudentAddress');
            $user->birthday = $request->input('adminNewStudentBirthday');
            $user->password = "student1";
            $user->permission = "3";

            if (
                $user->dni !== null && $user->dni !== '' &&
                $user->email !== null && $user->email !== '' &&
                $user->name !== null && $user->name !== '' &&
                $user->address !== null && $user->address !== '' &&
                $user->birthday !== null && $user->birthday !== ''
            ) {
                try {
                    $user->save();
                    return back()->with("Correct", "Teacher added successfully");
                } catch (\Throwable $th) {
                    return back()->with("Incorrect", "Error");
                }
            } else {
                return back()->with("Incorrect", "Please fill in all the required fields");
            }
        }
    }
    public function update(Request $request)
    {
        if ($request->has('adminPermissionAccept')) {
            if ($request->has('adminPermissionStatus')) {
                $status = 1;
            } else {
                $status = 0;
            }

            // Verificar los valores de las variables
            //dd($request->all());

            try {
                $query = "UPDATE users SET permission=?, status=? WHERE id=?";
                $bindings = [
                    $request->adminPermissionPermission,
                    $status,
                    $request->adminPermissionID,
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
                return back()->with("Correct", "Permissions Updated");
            } else {
                return back()->with("Incorrect", "Error");
            }
        } else if ($request->has('adminTeacherAccept')) {

            // Verificar los valores de las variables
            //dd($request->all());

            if ($request->adminTeacherClass === NULL && $request->adminTeacherOldClass === NULL) {
                try {
                    $query = "UPDATE users SET name=?, address=?, birthday=? WHERE id=?";
                    $bindings = [
                        $request->adminTeacherName,
                        $request->adminTeacherAddress,
                        $request->adminTeacherBirthday,
                        $request->adminTeacherID,
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
            } else if ($request->adminTeacherClass === NULL && $request->adminTeacherOldClass != NULL) {
                try {
                    $oldClass = $request->adminTeacherOldClass;
                    $class = NULL;
                    $teacherID = NULL;
                    $teacher = NULL;
                    $query = "UPDATE users SET name=?, address=?, birthday=?, class=? WHERE id=?";
                    $queryCourses = "UPDATE courses SET teacherID=?, teacher=? WHERE class=?";
                    $bindings = [
                        $request->adminTeacherName,
                        $request->adminTeacherAddress,
                        $request->adminTeacherBirthday,
                        $class,
                        $request->adminTeacherID,
                    ];
                    $bindingsCourses = [
                        $teacherID,
                        $teacher,
                        $oldClass,
                    ];

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
                    $sqlCourses = 0;
                }

                if ($sql == true && $sqlCourses == true) {
                    return back()->with("Correct", "Information Updated");
                } else {
                    return back()->with("Incorrect", "Error");
                }
            } else if ($request->adminTeacherClass != NULL && $request->adminTeacherOldClass != NULL) {
                if ($request->adminTeacherClass == $request->adminTeacherOldClass) {
                    try {
                        $query = "UPDATE users SET name=?, address=?, birthday=?, class=? WHERE id=?";
                        $queryCourses = "UPDATE courses SET teacherID=?, teacher=? WHERE class=?";
                        $bindings = [
                            $request->adminTeacherName,
                            $request->adminTeacherAddress,
                            $request->adminTeacherBirthday,
                            $request->adminTeacherClass,
                            $request->adminTeacherID,
                        ];
                        $bindingsCourses = [
                            $request->adminTeacherID,
                            $request->adminTeacherName,
                            $request->adminTeacherClass,
                        ];

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
                        $sqlCourses = 0;
                    }

                    if ($sql == true && $sqlCourses == true) {
                        return back()->with("Correct", "Information Updated");
                    } else {
                        return back()->with("Incorrect", "Error");
                    }
                } else {
                    try {
                        $oldTeacherId = NULL;
                        $oldTeacher = NULL;
                        $query = "UPDATE users SET name=?, address=?, birthday=?, class=? WHERE id=?";
                        $queryCourses = "UPDATE courses SET teacherID=?, teacher=? WHERE class=?";
                        $queryOldCourses = "UPDATE courses SET teacherID=?, teacher=? WHERE class=?";
                        $bindings = [
                            $request->adminTeacherName,
                            $request->adminTeacherAddress,
                            $request->adminTeacherBirthday,
                            $request->adminTeacherClass,
                            $request->adminTeacherID,
                        ];
                        $bindingsCourses = [
                            $request->adminTeacherID,
                            $request->adminTeacherName,
                            $request->adminTeacherClass,
                        ];
                        $bindingsOldCourses = [
                            $oldTeacherId,
                            $oldTeacher,
                            $request->adminTeacherOldClass,
                        ];

                        $sql = DB::update($query, $bindings);
                        $sqlCourses = DB::update($queryCourses, $bindingsCourses);
                        $sqlOldCourses = DB::update($queryOldCourses, $bindingsOldCourses);

                        // Verificar el valor de $sql
                        //dd($sql);
                        //dd($sqlCourses);
                        //dd($sqlOldCourses);

                        if ($sql == 0 && $sqlCourses == 0 && $sqlOldCourses == 0) {
                            $sql = 1;
                            $sqlCourses = 1;
                            $sqlOldCourses = 1;
                        }
                    } catch (\Throwable $th) {
                        // Verificar el error
                        //dd($th);
                        $sql = 0;
                        $sqlCourses = 0;
                        $sqlOldCourses = 0;
                    }

                    if ($sql == true && $sqlCourses == true && $sqlOldCourses == true) {
                        return back()->with("Correct", "Information Updated");
                    } else {
                        return back()->with("Incorrect", "Error");
                    }
                }
            } else if ($request->adminTeacherClass != NULL && $request->adminTeacherOldClass === NULL) {
                try {
                    $query = "UPDATE users SET name=?, address=?, birthday=?, class=? WHERE id=?";
                    $queryCourses = "UPDATE courses SET teacherID=?, teacher=? WHERE class=?";
                    $bindings = [
                        $request->adminTeacherName,
                        $request->adminTeacherAddress,
                        $request->adminTeacherBirthday,
                        $request->adminTeacherClass,
                        $request->adminTeacherID,
                    ];
                    $bindingsCourses = [
                        $request->adminTeacherID,
                        $request->adminTeacherName,
                        $request->adminTeacherClass,
                    ];

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
                    $sqlCourses = 0;
                }

                if ($sql == true && $sqlCourses == true) {
                    return back()->with("Correct", "Information Updated");
                } else {
                    return back()->with("Incorrect", "Error");
                }
            }
        } else if ($request->has('adminStudentAccept')) {
            // Verificar los valores de las variables
            //dd($request->all());

            try {
                $query = "UPDATE users SET dni=?, name=?, address=?, birthday=? WHERE id=?";
                $bindings = [
                    $request->adminStudentDNI,
                    $request->adminStudentName,
                    $request->adminStudentAddress,
                    $request->adminStudentBirthday,
                    $request->adminStudentID,
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
        }
    }
}

?>
