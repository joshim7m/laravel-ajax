<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Task;

class TaskController extends Controller
{

    public function index()
    {

        $tasks = Task::orderBy('id', 'desc')->paginate(5);
        return view('task.index')->with('tasks',$tasks); 
    }

    public function getData(Request $request){

        $tasks = Task::orderBy('id', 'desc')->get();
        if($request->ajax()){

            return response()->json(['error'=>false, 'tasks'=> $tasks ], 200);
        }
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), 
            array( 
                'name'          => 'required', 
                'description'   => 'required', 
            ));

         if ($validator->fails()) {
          return response()->json([ 'error' => true, 'messages' => $validator->errors(), ], 422); 
        } 

        $task = new Task;
        $task->name         = $request->name;
        $task->description  = $request->description;
        $task->save();

        return response()->json([ 'error' => false, 'task' => $task, ], 200); 
    }


    public function show($id)
    {
        $task = Task::find($id); 
        return response()->json([ 'error' => false, 'task' => $task, ], 200); 
    }


    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), 
            array( 
                'name'          => 'required', 
                'description'   => 'required', 
            )); 

        if ($validator->fails()) {
         return response()->json([ 'error' => true, 'messages' => $validator->errors(), ], 422); 
         } 

         $task = Task::find($id); 
         $task->name = $request->input('name'); 
         $task->description = $request->input('description'); 
         $task->save(); 

         return response()->json([ 'error' => false, 'task' => $task, ], 200); 
    }


    public function destroy($id)
    {
        $task = Task::destroy($id);
        return response()->json([ 'error' => false, 'task' => $task, ], 200);
    }
}
