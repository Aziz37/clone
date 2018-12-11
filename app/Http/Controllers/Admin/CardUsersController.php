<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardUsersController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$user = User::findOrFail($request->input('member'));
    	$card = $request->input('card_id');

    	$user->cards()->attach($card);

    	return redirect()->back();
    }
}
