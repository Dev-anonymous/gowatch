<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserWebController extends Controller
{
    function index()
    {
        $phones = auth()->user()->phones()->orderBy('id', 'desc')->get();
        return view('user.remote_control', compact('phones'));
    }

    function sponsorship()
    {
        $user = auth()->user();
        $users = $user->users()->orderBy('name')->get();
        $withdraws = $user->withdraws()->orderBy('id', 'desc')->get();
        $balance = $user->balances()->get();
        $father = $user->user;
        return view('user.sponsorship', compact('users', 'withdraws', 'balance', 'father'));
    }
}
