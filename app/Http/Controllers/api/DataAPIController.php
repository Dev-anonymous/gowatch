<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAPIController extends Controller
{
    function phoneapps()
    {
        $user = Auth::user();
        $phone_id = request('phone_id');
        $phone = Phone::where('id', $phone_id)->with(['apps' => function ($q) {
            $q->orderBy('name');
        }])->get();

        abort_if(!$phone_id || !count($phone), 422, "No phone");
        if ($user->user_role == 'client') {
            $up = $user->phones->pluck('id')->all();
            abort_if(!in_array($phone_id, $up), 403, "No data");
        }

        $phone = $phone->map(function ($e) {
            $o = (object) $e->toArray();
            $o->updatedon = $e->updatedon?->format('d-m-Y H:i:s');
            $o->fcm = !!$e->fcm;
            $o->data = (object) json_decode($e->data);
            $o->perms = (object) json_decode($e->perms);
            $o->config = (object) json_decode($e->config);
            $o->name = $o->name;
            return $o;
        });
        return $phone[0];
    }
}
