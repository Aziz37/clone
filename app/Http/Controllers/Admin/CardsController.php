<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\User;
use App\Admin;
use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|string'
    	]);

        $boardId = $request->input('board_id');
        $listId = $request->input('list_id');

    	$card = new Card;

        $card->admin_id = Auth::user()->id;
        $card->board_id = $boardId;
        $card->listing_id = $listId;
    	$card->title = $request->input('title');

    	$card->save();

        $admin = Admin::findOrFail(Auth::user()->id);
        $admin->cards()->attach($card->id);

        session()->flash('message', 'Card created');

    	return redirect()->back();
    }

    public function show($id)
    {
        $card = Card::findOrFail($id);
        $users = User::all();
        
        return view('admin.cards.show', compact('card', 'users'));
    }

    public function update($id, Request $request)
    {
        $cardId = $request->input('card_id');

        if($request->has('date') && $request->has('time'))
        {
            Card::where('id', '=', $cardId)->update([
                'due_date' => $request->input('date'),
                'due_time' => $request->input('time')
            ]);

            session()->flash('message', 'Task deadline has been set');

            return redirect()->back();
        }

        if($request->has('clear'))
        {
            Card::where('id', '=', $cardId)->update([
                'due_date' => NULL,
                'due_time' => NULL
            ]);

            session()->flash('message', 'Task deadline has been removed');

            return redirect()->back();
        }

        if($request->has('desc'))
        {
            Card::where('id', '=', $cardId)->update([
                'description' => $request->input('description')
            ]);

            session()->flash('message', 'Task description updated');

            return redirect()->back();
        }

        if($request->has('color'))
        {
            Card::where('id', '=', $cardId)->update([
                'color' => $request->input('color')
            ]);

            session()->flash('message', 'Color has been associated with this task');

            return redirect()->back();
        }

        Card::where('id', '=', $cardId)->update([
            'listing_id' => $request->input('list_id')
        ]);

        session()->flash('message', 'Task has been moved');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $card = Card::findOrFail($id);
        $boardId = $card->board_id;

        $card->delete();

        session()->flash('message', 'Task deleted');

        return redirect()->action('Admin\BoardsController@show', compact('boardId'));
    }
}
