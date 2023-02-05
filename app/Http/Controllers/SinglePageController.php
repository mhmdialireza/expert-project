<?php

namespace App\Http\Controllers;

class SinglePageController extends Controller
{
    public function home()
    {
        $from = 'home';
        return view('pages.home', compact('from'));
    }

    public function profile()
    {
        $from = 'profile';
        return view('pages.home', compact('from'));
    }
}
