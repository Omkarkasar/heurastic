<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studentstore(Request $request)
    {

        // $validateData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:students,email',
        //     'dob' => 'required|date',
        //     'phone' => 'required|unique:students,phone|digits:10',
        //     'address' => 'required|max:150',
        // ]);
        

        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->dob = $request->dob;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->save();

        return response()->json(['success' => 'Student data stored successfully']);
    }
    public function studentget()
    {
        $data=Student::all();
        return response()->json($data);
    }

   
    public function studentedit($id)
    {
        $data=Student::findOrFail($id);
        return response()->json($data);

    }
    public function studentupdate($id,Request $request)
    {
        $data=Student::findOrFail($id);
        $data->name=$request->name;
        $data->email=$request->email;
        $data->dob=$request->dob;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->save();
        return response()->json(['success'=>'Student Details Updated Successfully']);
    }
    public function studentdelete($id)
    {
        $data=Student::findOrFail($id);
        $data->delete();
        return response()->json(['success'=>'Student Details deleted Successfully']);
    }
}