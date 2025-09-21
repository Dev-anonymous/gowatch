<?php

namespace App\Http\Controllers;

use App\Models\DemandeTransfert;
use App\Models\Solde;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminWebController extends Controller
{
    public function index()
    {

        return view('admin/index');
    }

    public function remote_control()
    {
        $users = User::where('user_role', 'marchand')->orderBy('name')->get();
        return view('admin/remote_control', compact('users'));
    }

    public function cash_out()
    {
        return view('admin/cash_out');
    }

    public function merchant()
    {
        return view('admin/merchant');
    }

    public function feedback()
    {
        return view('admin/feedback');
    }

    public function bank()
    {
        return view('admin/bank');
    }
}
