<?php

namespace App\Http\Controllers\Admin;

use App\Card;
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
		]);

		$board = new Board;

		$board->admin_id = Auth::user()->id;
		$board->title = $request->input('title');

		$board->save();

		return redirect()->back();
	}

	public function show($id)
	{
		$board = Board::findOrFail($id);
		$boards = Board::all();

		return view('admin.boards.show', compact('board', 'boards'));
	}
}
