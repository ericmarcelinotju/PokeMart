<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function insert(Request $request){

    	$this->validate($request, [
	        'comment' => 'required|min:3',
	    ]);

    	$comment = new Comment();
    	$comment->user_id = Auth::user()->id;
    	$comment->pokemon_id = $request->pokemon_id;
    	$comment->content = $request->comment;
    	$comment->save();

    	return back();
    }
}
