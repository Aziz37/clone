<?php

namespace App\Http\Controllers\Admin;

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ListingsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'name' => 'required|string',
		]);

    	$boardId = $request->input('board_id');

		$list = new Listing;
		
		$list->board_id = $boardId;
		$list->name = $request->input('name');

		$list->save();

        session()->flash('message', 'List created');

		return redirect()->action('Admin\BoardsController@show', compact('boardId'));
    }

    public function destroy($id)
    {
        $list = Listing::findOrFail($id);

        $list->cards()->delete();
        $list->delete();

        session()->flash('message', 'List removed');
        
        return redirect()->back();
    }
}
