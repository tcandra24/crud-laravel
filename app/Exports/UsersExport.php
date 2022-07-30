<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
     * view
     *
     * @return View
     */
    public function view(): View
    {
        return view('exports.users', [
            'users' => User::all()
        ]);
    }
}
