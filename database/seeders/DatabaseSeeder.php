<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $userAdmin = new User();
        $userAdmin->name = "Administrator";
        $userAdmin->email = "admin@admin";
        $userAdmin->password = Hash::make('password');
        $userAdmin->permission = 1;
        $userAdmin->status = 1;
        $userAdmin->save();

        $userTeacher = new User();
        $userTeacher->name = "Michel P";
        $userTeacher->email = "teacher@teacher";
        $userTeacher->password = Hash::make('password');
        $userTeacher->permission = 2;
        $userTeacher->status = 1;
        $userTeacher->save();

        $userStudent = new User();
        $userStudent->name = "Tristan A";
        $userStudent->email = "student@student";
        $userStudent->password = Hash::make('password');
        $userStudent->permission = 3;
        $userStudent->status = 1;
        $userStudent->save();

        $user = new User();
        $user->name = "User";
        $user->email = "user@user";
        $user->password = Hash::make('password');
        $user->permission = 1;
        $user->status = 0;
        $user->save();

        $course1 = new Course();
        $course1->class = "Spanish";
        $course1->save();

        $course2 = new Course();
        $course2->class = "Italian";
        $course2->save();

        $course3 = new Course();
        $course3->class = "Russian";
        $course3->save();
    }
}
