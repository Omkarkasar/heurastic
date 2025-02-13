<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    // public function enrollmentget()
    // {
    //     $enrollments = Enrollment::with(['student', 'course'])->get();
    //     return response()->json($enrollments);
    // }

    public function enrollmentstore(Request $request)
    {
        // $request->validate([
        //     'student_id' => 'required|exists:students,id',
        //     'course_id' => 'required|exists:courses,id',
        //     'enrollment_date' => 'required|date',
        // ]);

        $enrollment = new Enrollment();
        $enrollment->studentid = $request->studentid;
        $enrollment->courseid = $request->courseid;
        $enrollment->enrollmentdate = $request->enrollmentdate;
        $enrollment->save();
        return response()->json(['success' => 'Enrollment added successfully']);
    }
    public function enrollmentget()
    {
        $data=Enrollment::all();
        return response()->json($data);
    }


}
