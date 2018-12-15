<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CardsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'title' => 'required|string'
    	]);

        $boardId = $request->input('board_id');
        $listId = $request->input('list_id');

    	$card = new Card;

    	$card->user_id = Auth::user()->id;
        $card->board_id = $boardId;
        $card->listing_id = $listId;
    	$card->title = $request->input('title');

    	$card->save();

        $user = User::findOrFail(Auth::user()->id);
        $user->cards()->attach($card->id);

    	return redirect()->back();
    }

    public function show($id)
    {
        $card = Card::findOrFail($id);
        
        return view('users.cards.show', compact('card'));
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

            return redirect()->back();
        }

        if($request->has('clear'))
        {
            Card::where('id', '=', $cardId)->update([
                'due_date' => NULL,
                'due_time' => NULL
            ]);

            return redirect()->back();
        }

        if($request->has('desc'))
        {
            Card::where('id', '=', $cardId)->update([
                'description' => $request->input('description')
            ]);

            return redirect()->back();
        }

        Card::where('id', '=', $cardId)->update([
            'listing_id' => $request->input('list_id')
        ]);

        return redirect()->back();
    }
}
