<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Phone;
use App\Models\Taux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $o->subscription = phonesubscription($e);
            return $o;
        });
        return $phone[0];
    }

    function subinfo()
    {
        if (request('action') == 'subscription') {
            $validator = Validator::make(request()->all(), [
                'devise' => 'required|in:CDF,USD',
                'phone_id' => 'required|numeric|exists:phone,id',
                'subtype' => 'required|string|in:basic,premium',
            ]);
            if ($validator->fails()) {
                abort(422, implode(' ', $validator->errors()->all()));
            }
            $data = $validator->validate();
            gettaux();
            $subamount = v($data['subtype'] == 'basic' ? 10 : 15, 'USD');
            $payamount = $data['subtype'] == 'basic' ? 10 : 15;
        } else if (request('action') == 'reset') {
            $validator = Validator::make(request()->all(), [
                'devise' => 'required|in:CDF,USD',
                'phone_id' => 'required|numeric|exists:phone,id',
            ]);
            if ($validator->fails()) {
                abort(422, implode(' ', $validator->errors()->all()));
            }
            $data = $validator->validate();
            gettaux();
            $subamount = v(5, 'USD');
            $payamount =  5;
        } else {
            abort(403, "Invalid action");
        }

        if ($data['devise'] == 'CDF') {
            $taux = Taux::first();
            abort_if(!$taux,  403, "Payment not available");
            $payamount *= $taux->usd_cdf;
            $payamount = round($payamount);
        }
        return [
            'subamount' => $subamount,
            'payamount' => $payamount,
        ];
    }
}
