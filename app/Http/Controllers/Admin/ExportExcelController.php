<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Card;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportExcelController extends Controller
{
	public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    // public function export()
    // {
    // 	$users = User::with(['boards', 'cards'])->get();
    // 	$cards = Card::with('list')->get();

    // 	return view('admin.exports.excel', compact('users','cards'));
    // }
}
