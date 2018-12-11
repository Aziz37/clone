<?php

namespace App\Http\Controllers\Admin;

use App\Card;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCardsContoller extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    public function store(Request $request)
    {
    	$admin = Admin::findOrFail($request->input('admin_id'));
    	$card = $request->input('card_id');

    	$admin->cards()->attach($card);

    	return redirect()->back();
    }
}
