<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
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

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('admin.profile', compact('admin'));
    }

    public function update($id, Request $request)
    {
        if($request->has('password'))
        {
            $this->validate($request, [
                'password' => 'required|string|min:6|confirmed'
            ]);

            $admin = Admin::findOrFail($id);

            if(!Hash::check($request->input('current_password'), $admin->password))
            {
                session()->flash('message', 'CURRENT PASSWORD IS INCORRECT ! Please try again');
                return redirect()->back();
            }

            Admin::where('id', '=', $id)->update([
                'password' => Hash::make($request->input('password'))
            ]);

            session()->flash('message', 'Password Changed Successfully !');

            return redirect()->back();
        }

        $this->validate($request, [
            'email'     =>  'required|string|email|max:255',
            'department'=>  'required|string|max:255'
        ]);
        
        Admin::where('id', $id)->update([
            'email'     =>  $request->input('email'),
            'department'=>  $request->input('department')
        ]);

        session()->flash('message', 'Admin Details Changed Successfully !');

        return redirect()->back();
    }
}
