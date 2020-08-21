<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection;


class ApiController extends Controller
{
    public function getPost(){

    	$post = Post::find(11);
      return new PostResource($post);
    }


    public function getPosts(){

    	//$posts = Post::orderBy('id', 'desc')->get();
    	$posts = Post::latest()->paginate(3);
    	return new PostCollection($posts);
    }

}
