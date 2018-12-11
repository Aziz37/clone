<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BoardUsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function store(Request $request)
    {
    	$user = User::findOrFail($request->input('member'));
    	$board = $request->input('board_id');

    	$user->boards()->attach($board);

    	return redirect()->back();
    }
}
