<?php

namespace App\Http\Controllers\Admin;

use App\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminId = Auth::user()->id;

        $boards = Board::where('admin_id', '=', $adminId)->get();

        return view('admin.home', compact('boards'));
    }
}
