<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function coursestore(Request $request)
    {

        // $validateData = $request->validate([
        //     'coursename' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',
        //     'duration' => 'required',
        // ]);


        $course = new Course();
        $course->coursename = $request->coursename;
        $course->description = $request->description;
        $course->duration = $request->duration;
        $course->save();

        return response()->json(['success' => 'Course data stored successfully']);
    }
    public function courseget()
    {
        $course = Course::all();
        return response()->json($course);
    }
    public function courseedit($id)
    {
        $data = Course::findOrFail($id);
        return response()->json($data);
    }
    public function courseupdate($id, Request $request)
    {
        // $validateData = $request->validate([
        //     'coursename' => 'required|string|max:255',
        //     'description' => 'required|max:150',
        //     'duration' => 'required',

        // ]);
        $data = Course::findOrFail($id);
        $data->coursename = $request->coursename;
        $data->description = $request->description;
        $data->duration = $request->duration;
        $data->save();
        return response()->json(['success' => 'Course Details Updated Successfully']);
    }
    public function Coursedelete($id)
    {
        $data=Course::findOrFail($id);
        $data->delete();
        return response()->json(['success'=>'Course Details deleted Successfully']);
    }

}
