<?php

namespace App\Http\Controllers\Admin;

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
		$this->middleware('auth:admin');
	}

    public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string',
			'objective' => 'required',
		]);

		$board = new Board;

		$board->admin_id = Auth::user()->id;
		$board->title = $request->input('title');
		$board->objective = $request->input('objective');

		$board->save();

		return redirect()->back();
	}

	public function show($id)
	{
		$board = Board::findOrFail($id);
		$boards = Board::all();
		$users = User::all();

		return view('admin.boards.show', compact('board', 'boards', 'users'));
	}

	public function update($id, Request $request)
	{
		$boardId = $request->input('board_id');

		if($request->has('date') && $request->has('time'))
        {
            Board::where('id', '=', $boardId)->update([
                'due_date' => $request->input('date'),
                'due_time' => $request->input('time')
            ]);

            return redirect()->back();
        }

        if($request->has('clear'))
        {
            Board::where('id', '=', $boardId)->update([
                'due_date' => NULL,
                'due_time' => NULL
            ]);

            return redirect()->back();
        }
	}
}
