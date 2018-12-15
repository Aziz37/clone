<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Board;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $boards = Board::all();

        return view('users.home', compact('boards'));
    }

        public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.profile', compact('user'));
    }

    public function update($id, Request $request)
    {
        if($request->has('password'))
        {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $user = User::findOrFail($id);

            if(!Hash::check($request->input('current_password'), $user->password))
            {
                session()->flash('message', 'CURRENT PASSWORD IS INCORRECT ! Please try again');
                return redirect()->back();
            }

            User::where('id', '=', $id)->update([
                'password' => Hash::make($request->input('password'))
            ]);

            session()->flash('message', 'Password Changed Successfully !');

            return redirect()->action('Auth\LoginController@userLogout');
        }

        $this->validate($request, [
            'email'     =>  'required|string|email|max:255',
            'department'=>  'required|string|max:255'
        ]);
        
        User::where('id', $id)->update([
            'email'     =>  $request->input('email'),
            'department'=>  $request->input('department')
        ]);

        session()->flash('message', 'User Details Changed Successfully !');

        return redirect()->back();
    }
}
