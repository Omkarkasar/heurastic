<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function studentform()
    {
        return view('studentform');
    }
    public function courseform()
    {
        return view('courseform');
    }
    public function enrollmentform()
    {
        $students = Student::all(); // Fetch all students
        $courses = Course::all();   // Fetch all courses

        return view('enrollmentform', compact('students', 'courses'));
    }
    public function teacherform()
    {
        return view('teacherform');
    }
    public function taskform()
    {
        $students = Student::all(); // Fetch all students
        $teachers = Teacher::all(); // Fetch all student
        return view('taskform', compact('students', 'teachers'));
    }

}
