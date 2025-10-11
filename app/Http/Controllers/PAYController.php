<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gopay;
use App\Models\Phone;
use App\Models\Taux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PAYController extends Controller
{
    public function init_payment()
    {
        $user = Auth::user();
        abort_if($user->user_role != 'client', 403, 'Nah');

        if (request('action') == 'subscription') {
            $validator = Validator::make(request()->all(), [
                'devise' => 'required|in:CDF,USD',
                'phone_id' => 'required|numeric|exists:phone,id',
                'subtype' => 'required|string|in:basic,premium',
                'phone' => 'required|string|min:9|max:9',
                'action' => 'required|string|in:subscription',
            ]);

            if ($validator->fails()) {
                abort(422, implode(' ', $validator->errors()->all()));
            }
            $data = $validator->validate();
            gettaux();

            $payamount = $data['subtype'] == 'basic' ? 10 : 15;
            if ($data['devise'] == 'CDF') {
                $taux = Taux::first();
                abort_if(!$taux,  403, "Payment not available");
                $payamount *= $taux->usd_cdf;
                $payamount = round($payamount);
            }
        } else if (request('action') == 'reset') {
            $validator = Validator::make(request()->all(), [
                'devise' => 'required|in:CDF,USD',
                'phone_id' => 'required|numeric|exists:phone,id',
                'phone' => 'required|string|min:9|max:9',
                'action' => 'required|string|in:reset',
            ]);
            if ($validator->fails()) {
                abort(422, implode(' ', $validator->errors()->all()));
            }
            $data = $validator->validate();
            gettaux();

            $payamount = 5;
            if ($data['devise'] == 'CDF') {
                $taux = Taux::first();
                abort_if(!$taux,  403, "Payment not available");
                $payamount *= $taux->usd_cdf;
                $payamount = round($payamount);
            }
        } else {
            abort(403, "Invalid action");
        }

        $tel = request()->phone;
        $tel = "+243" . ((int) $tel);

        $ok = preg_match('/(\+24390|\+24399|\+24397|\+24398|\+24380|\+24381|\+24382|\+24383|\+24384|\+24385|\+24389)[0-9]{7}/', $tel);

        if (!$ok) {
            $m = "Le numéro $tel est invalide";
            return response([
                'success' => false,
                'message' => $m
            ]);
        }

        $phone = Phone::where('id', request('phone_id'))->first();
        abort_if($phone->users_id != $user->id, 403, "Nah");
        $sub = phonesubscription($phone);
        abort_if($sub->type !== 'BASIC' && request('action') == 'reset', 403, "Payment not available !");

        $myref = 'myref' . time() . rand(10000, 90000);
        $paydata = [
            'action' => $data['action'],
            'phone_id' => $phone->id,
            'montant' => $payamount,
            'devise' => $data['devise'],
            'telephone' => $tel,
        ];
        if (isset($data['subtype'])) {
            $paydata['subtype'] = $data['subtype'];
        }

        $gopay = Gopay::create([
            'myref' => $myref,
            'issaved' => 0,
            'isfailed' => 0,
            'paydata' => json_encode($paydata),
        ]);
        $r = gopay_init_payment($payamount, $data['devise'], $tel, $myref);

        $ref = null;
        if ($r->success) {
            $ref = $r->data->ref;
            $gopay->update(compact('ref'));
        }

        return response([
            'success' => $r->success,
            'message' => $r->message,
            'data' => ['myref' => $myref]
        ]);
    }

    public function check_payment()
    {
        $myref = request()->myref;
        $ok =  false;
        $issaved = 0;
        $trans = Gopay::where(['myref' => $myref])->lockForUpdate()->first();

        if (!$trans) {
            return response([
                'success' => false,
                'message' => "Invalid ref"
            ]);
        };

        $t = transaction_status($myref);
        $status = @$t->status;

        if ($status === 'success') {
            $issaved = @Gopay::where(['myref' => $myref])->first()->issaved;
            if ($issaved !== 1) {
                $paydata = json_decode($trans->paydata);
                saveData($paydata, $trans);
                $ok =  true;
                $trans->update(['isfailed' => 0]);
            }
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }

        if ($ok || $issaved === 1 || @$trans->issaved === 1) {
            return response([
                'success' => true,
                'message' => 'Votre transaction est effectuée.',
                'transaction' => $t
            ]);
        } else {
            $m = "Aucune transation trouvée.";
            return response([
                'success' => false,
                'message' => $m,
                'transaction' => $t
            ]);
        }
    }
}
