<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teacherstore(Request $request)
    {
        // $request->validate([
        //     'teachername' => 'required|string',
        //     'teacheremail' => 'required|unique|string',
        // ]);

        $teacher = new Teacher();
        $teacher->teachername = $request->teachername;
        $teacher->teacheremail = $request->teacheremail;
        $teacher->save();
        return redirect()->route('teacherform')->with('success', 'Teacher added successfully');

    }
    public function teacherget()
    {
        $data=Teacher::all();
        return response()->json($data);
    }
    public function teacheredit($id)
    {
        $data =Teacher::findOrFail($id);
        return response()->json($data);
    }
    public function teacherupdate($id, Request $request)
    {
        // $validateData = $request->validate([
        //     'teachername' => 'required|string|max:255',
        //     'teacheremail' => 'required|unique|string',
        // ]);
        $data = Teacher::findOrFail($id);
        $data->teachername = $request->teachername;
        $data->teacheremail = $request->teacheremail;
        $data->save();
        return response()->json([
            'success' => 'Teacher updated successfully'
        ]);  
    }
    public function teacherdelete($id)
    {
        $data=Teacher::findOrFail($id);
        $data->delete();
        return response()->json(['success'=>'Teacher Details deleted Successfully']);
    }
}
