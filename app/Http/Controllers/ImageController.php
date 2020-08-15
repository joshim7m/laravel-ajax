<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    
    public function showForm(){

    	return view('image/img_form');
    }


    public function upLoad(Request $request){

    	return response()->json(['result'=>$request->file]);
    }
}
