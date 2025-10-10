<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        abort_if(!in_array($user->user_role, ['admin']), 403, "No permission");
        $user_id = request('user_id');

        if ($user->user_role == 'admin') {
            $phones = Phone::orderBy('id', 'desc')->where('users_id', $user_id)->get();
            return $phones;
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
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Phone $phone)
    {
        $user = Auth::user();
        abort_if(!in_array($user->user_role, ['admin', 'client']), 403, "No permission");

        if ($user->user_role === 'admin') {
            if (request()->has('maskall')) {
                $maskall = request('maskall');
                $config = (object) @json_decode($phone->config);
                $config->hidenotifications = $maskall == "true";
                $config->hidenotificationfor = [];
                $phone->config = json_encode($config);
                $phone->save();
                return [
                    'success' => true,
                    'message' => "Paramètre enregistré.",
                ];
            }
            if (request()->has('maskfor')) {
                $maskfor = (array) request('maskfor');
                $config = (object) @json_decode($phone->config);
                $config->hidenotifications = false;
                $config->hidenotificationfor = $maskfor;
                $phone->config = json_encode($config);
                $phone->save();
                return [
                    'success' => true,
                    'message' => "Paramètre enregistré.",
                ];
            }
        } elseif ($user->user_role == 'client') {
            $name = request('name');
            isHisPhone();
            $phone->name = ucfirst($name);
            $phone->save();
            return [
                'success' => true,
                'message' => "Le nom du téléphone a été modifié",
            ];
        }

        abort(422, "No params");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Phone  $phone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phone $phone)
    {
        //
    }
}
