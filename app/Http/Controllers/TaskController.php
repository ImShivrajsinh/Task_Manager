<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    //displaying all tasks
    public function ShowTask(){

        $userId = Auth::id();
        $tasks = DB::table('_tasks')
                    ->where('user_id', $userId)
                    ->get();
        return view('dashbord',['data' => $tasks]);
    }


    //add task
    public function AddTask(Request $req){

        $user = Auth::user();
        $task = DB::table('_tasks')
            ->insert(
                [
                    'taskname' => $req->taskname,
                    'taskdescription' => $req->taskdescription,
                    'duedate'=>$req->duedate,
                    'user_id'=> $user->id,
                ]
                );
                return redirect()->route('dashboard')->with('success', 'Task added successfully!');
    }

    //delete task
    public function DeleteTask(String $id){
        $task = DB::table('_tasks')
                    ->where('id', $id)
                    ->delete();
                    return redirect()->route('dashboard')->with('success', 'Task deleted successfully!');

    }


    //mark as completed
    public function markcompleted(String $id ){
        $task = DB::table('_tasks')
                    ->where('id',$id)
                    ->update(['status'=> 'completed']);
                    return redirect()->route('dashboard')->with('success', 'Task Mark Completed successfully!');

    }
    

    //For Edit
        //get edisting task details in model
public function edit($id){
    $task = DB::table('_tasks')
             ->where('id', $id)
             ->first();
    return response()->json([
           'status'=>200,
           'task'=> $task,
    ]);
}

//update task details
public function UpdateTask(Request $request)
    {
        $id= $request->input('taskId');
        $request->validate([
            'taskname' => 'required|string',
            'taskdescription' => 'required|string',
            'duedate' => 'required|date',
        ]);

        $updated = DB::table('_tasks')
            ->where('id', $id)
            ->update([
                'taskname' => $request->input('taskname'),
                'taskdescription' => $request->input('taskdescription'),
                'duedate' => $request->input('duedate'),
            ]);

        return redirect()->back()->with('success','Task updated successfully');
       
    }
}

