<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        return view("guest.index", [
            'auth' => Auth::user(),
            'title' => 'POS v0'
        ]);
    }
}
