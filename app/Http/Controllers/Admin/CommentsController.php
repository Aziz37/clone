<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'body' => 'required',
    	]);

    	$comment = new Comment;

    	$comment->admin_id = Auth::user()->id;
    	$comment->card_id = $request->input('card_id');
    	$comment->body = $request->input('body');

    	$comment->save();

    	return redirect()->back();
    }
}
