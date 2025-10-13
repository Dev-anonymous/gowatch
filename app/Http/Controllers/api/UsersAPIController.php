<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsersAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        abort_if($user->user_role != 'admin', 403);

        if (request()->has('datatable')) {
            $data = User::where('user_role', 'client');
            $dtable = DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['contact'])
                ->addColumn('contact', function ($data) {
                    $s = $data->telephone . "<br><small class='text-muted mt-1'>$data->email</small>";
                    return $s;
                })->editColumn('created_at', function ($data) {
                    return $data->created_at?->format('d-m-Y H:i:s');
                })->editColumn('derniere_connexion', function ($data) {
                    return $data->derniere_connexion?->format('d-m-Y H:i:s');
                })->addColumn('phones', function ($data) {
                    $s = $data->phones->pluck('phone')->all();
                    return implode(', ', $s);
                });

            return $dtable->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
