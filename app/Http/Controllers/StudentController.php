<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){

    	$students = Student::orderBy('id', 'desc')->get();
    	return view('student.index', compact('students'));

    }


    public function store(Request $request){

    	$validator = Validator::make($request->input(),
    		array(
    			'name' 	=> 'required',
    			'roll' 	=> 'required',
    			'level'	=> 'required',
    		)
    	);

    	if($validator->fails()){
    		return response()->json(['error'=>true, 'message'=>$validator->errors(),], 422);
    	}

    	$student = new Student;
    	$student->name = $request->name;
    	$student->roll = $request->roll;
    	$student->level = $request->level;
    	$student->save();

    	return response()->json(['error'=>false, 'student'=>$student,], 200);
    }


    public function show($id){

    	$student = Student::find($id);
    	return response()->json(['error'=>false, 'student'=>$student,], 200);
    }

    public function update(Request $request, $id){

    	$validator = Validator::make($request->input(),[
    		'name' => 'required',
    		'roll'	=> 'required'
    	]);
    	if($validator->fails()){
    		return response()->json(['error'=>true, 'message'=>$validator->errors(),], 422);
    	}

    	$student = Student::find($id);
    	$student->name = $request->name;
    	$student->roll = $request->roll;
    	$student->level = $request->level;
    	$student->save();

    	return response()->json(['error'=>false, 'student'=>$student, ], 200);
    }

    public function destroy($id){

    	$student = Student::destroy($id);
    	return response()->json(['error'=>false, 'student'=>$student, ], 200);
    }
}
