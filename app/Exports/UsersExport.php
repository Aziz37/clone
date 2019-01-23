<?php

namespace App\Exports;

use App\User;
use App\Card;
use App\Board;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function view(): View
    {
        $query = User::with(['boards', 'cards']);

        return view('admin.exports.excel', [
            'users' => $query->get()
        ]);
    }
}
