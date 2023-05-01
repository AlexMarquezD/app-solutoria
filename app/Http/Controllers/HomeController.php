<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function viewHome()
    {
        $token = Session::get('token');
        if (!$token) {
            return view('welcome');
        }

        return view('home');
    }
}
