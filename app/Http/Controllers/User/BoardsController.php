<?php

namespace App\Http\Controllers\User;

use App\Card;
use App\User;
use App\Board;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BoardsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function show($id)
    {
    	$board = Board::findOrFail($id);

    	if($board->users()->where('user_id', '=', Auth::user()->id)->exists() && $board->users()->where('board_id', '=', $board->id)->exists())
    	{
    		return view('users.boards.show', compact('board'));
    	}

    	session()->flash('message', 'You do not have access to this board');

        return redirect()->back();
    }
}
