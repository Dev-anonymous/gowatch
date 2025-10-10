<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserWebController extends Controller
{
    function index()
    {
        $phones = auth()->user()->phones()->orderBy('id', 'desc')->get();
        return view('user.remote_control', compact('phones'));
    }
}
