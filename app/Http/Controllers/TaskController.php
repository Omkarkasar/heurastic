<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function taskstore(Request $request)
    {
        
        $task = new task();
        $task->taskname = $request->taskname;
        $task->studentid = $request->studentid;
        $task->teacherid = $request->teacherid;
        $task->tasktitle = $request->tasktitle;
        $task->taskdescription = $request->taskdescription;
        $task->taskstatus = $request->taskstatus;
        $task->taskduedate = $request->taskduedate;
        $task->save();

        return response()->json(['success' => 'Student data stored successfully']);
    }
}
