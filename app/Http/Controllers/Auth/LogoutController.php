<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke()
    {
        Auth::logout();

        return redirect(route('index'));
    }
}
