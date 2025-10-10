<?php

use App\Models\Gopay;
use App\Models\History;
use App\Models\HttpToken;
use App\Models\Phone;
use App\Models\Subscription;
use App\Models\Taux;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

$xApiKey = "MFE2R0s0cEZMZVh2Rm8zb0tZNjNMdz09";

define('API_BASE', 'https://gopay.gooomart.com/api/v2');
define('API_HEADEARS',  [
    "Accept: application/json",
    "Content-Type: application/json",
    "x-api-key: $xApiKey"
]);

function gopay_init_payment($amount, $devise, $telephone, $myref)
{
    $_api_headers = API_HEADEARS;
    $telephone = (float) $telephone;
    $data = array(
        "telephone" => "+$telephone",
        "amount" => $amount,
        "devise" => $devise,
        "myref" => $myref,
    );

    $data = json_encode($data);
    $gateway = API_BASE . "/payment/init";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);
    $rep['success'] = false;
    if (curl_errno($ch)) {
        $rep['message'] = "Erreur, veuillez reessayer.";
    } else {
        $jsonRes = json_decode($response);
        $rep['success'] = @$jsonRes->success;
        $rep['message'] = @$jsonRes->message;
        $rep['data'] = @$jsonRes->data;
    }
    curl_close($ch);
    return (object) $rep;
}

function completeTrans()
{
    $pendingPayments = Gopay::where(['issaved' => '0', 'isfailed' => '0'])->get();
    foreach ($pendingPayments as $trans) {
        $paydata = json_decode($trans->paydata);
        $myref = $trans->myref;
        $t = transaction_status($myref);
        $status = @$t->status;
        if ($status === 'success') {
            saveData($paydata, $trans);
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }
    }
}

function transaction_status($myref)
{
    $_api_headers = API_HEADEARS;
    $gateway = API_BASE . "/payment/check/" . $myref;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);

    $status = null;
    if (!curl_errno($ch)) {
        curl_close($ch);
        $status = @json_decode($response)->transaction;
    }
    return $status;
}
function saveData($paydata, $trans)
{
    try {
        DB::transaction(function () use ($paydata, $trans) {
            $d = (array) $paydata;
            $action = $d['action'];
            if ($action == 'subscription') {
                $phone = Phone::where('id', $d['phone_id'])->first();
                $sub = $phone->subscriptions()->first();
                if ($sub) {
                    $end = nnow()->addDays(29);
                    $sub->update(['to' => $end, 'date' => nnow(), 'type' => strtoupper($d['subtype'])]);
                    $sub->histories()->create(['to' => $end, 'amount' => $d['montant'], 'currency' => $d['devise'], 'type' => strtoupper($d['subtype'])]);
                } else {
                    Subscription::create(['to' => $end, 'date' => nnow(), 'type' => strtoupper($d['subtype']), 'phone_id' => $phone->id, 'active' => 1]);
                }
                $phone->dailyactions()->whereDate('date', nnow())->delete();
                $trans->update(['issaved' => 1]);
            }
            if ($action == 'reset') {
                $phone = Phone::where('id', $d['phone_id'])->first();
                $sub = phonesubscription($phone);
                if ($sub->type === 'BASIC') {
                    $phone->dailyactions()->whereDate('date', nnow())->delete();
                }
                $trans->update(['issaved' => 1]);
            }
        });
    } catch (\Throwable $th) {
        // throw $th;
    }
}

function nnow()
{
    return now('Africa/Lubumbashi');
}

function v($amount, $append = '')
{
    return number_format($amount, 2, '.', ' ') . (empty($append) ? '' : " $append");
}

function makeRand($max = 5)
{
    $max = (int) $max;
    if (!$max or $max <= 0) {
        return 0;
    }

    $num = '';
    while ($max > 0) {
        $max--;
        $num .= rand(1, 9);
    }
    while (1) {
        $el = HttpToken::where('token', $num)->first();
        if ($el) {
            return makeRand($max);
        } else {
            break;
        }
    }
    return $num;
}

function fcmtoken()
{
    $credentialsFilePath =  [
        "type" => "service_account",
        "project_id" => "docta-2907c",
        "private_key_id" => "a5c0aeb7de7c7a9b47749b9fdc0eccf4334fa521",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCz4gWSLTbQIhcj\nSzMZUHucYNJ6pKNjU8YnjLkei3sZ6FaNhaR76AiMHE5Hl1VLXHWYciYFOUkvizSE\nzjRNT8UO4c0vHPqa1szKBYU0wFaL8HaYbPe2HK6vbERVlP/4LXCOd4mv6TiS/++p\nSlWEdJXdDZxtukTyDeHJ/XsK31ePhNN7MLMdCvPWxwBE0D/72rIBKo8fXdAbBQbC\nrqVaPUaxghNoiiJXkJ6JcIw0Xzx8xGKf/o/Q4eIAymuCZ+OxJjck2TjPQ+TCGsPq\nzKcRgR/gEQu2mWwKhiTOFIerJ2j4RbvsxazJLq7cX3r6z+RTUz1GhW9FDr1MCJjq\nkv/k2Ky/AgMBAAECggEANNE5x4kFHinUV2WeNGGgWfNH+gDbhK+1cClutZxI4fuJ\nZnaGLGeeEt3A0l6KCd21HbTumvwOFCqwmgod61Fv0AXXBG1i3BIUAYGLckjDYMWT\nXQAp38weMp38lpBwdEOLWBmbUQ6OsQL7MN8FqyW8VzLG6qUV12jiEjgeZ7vabuYX\n0bIU0TdRbivJh/4SDtns0eZ4QaRIPWcA2l2+sU6MrHEfg4QvKEAdkqQDmqMEND3O\nPd8Pg31uH7c4EuFFN5ouWFwYSBFBxBcsYrydcVKUl03VafE9RVTQu3g3mdCmxpVE\nKWj/warIlXDiM06W7516189Ccwyw3OLXVT98F1OOcQKBgQDrNYCKGQyE9R67Baa1\ndHW+xFOtd1A9jVUvgf4OQD8Twi2iATUYVTwwgF0bQ6E52RrIOgz8yImmUcs8SKdf\n1rwyg/q7+bGYr9VxbSlZnIfpSeE2Sfd7+/PCYbhUycK0+uk7eFiHJ66m16zJK0Bx\nV2co4SIAaK4nTpPmB7uauZkAeQKBgQDDyI5tzeL3TYGWd79daulkKREEDtQ49VTe\nKmX/G6BGt6TZpEQzfz8UerGTu9o3RymyS7EWQ8JOsUD8kHyLxT4vAZtIbfFrb74E\n1taPB+koMZtADiD70q2aR/L0GcHR62an4KKcmHW3vedXaSOiULoJ+bwcaiofU//T\nA1FYHuT49wKBgQDam0RXlcZkAKpKKotyFMamwjP/gmgqfSRSXmAxAJdfltbwvmyJ\nrBagAX4HrAi6CkVxGTse6oe89EKPSft+AMezr6SndwAQKESaAlovNmO/eHIAEikZ\nq+c3n7lB3K/Bo36ITmcBXuldmhC2fCON9C0l+nCurpxGXirp3gAIYz2ICQKBgQCj\n16oCEEO5i/4/qrTV+8uXi5p21+YYSI8eYUL8S+VEaRknHgYJRprGi6siJBoJGp+1\nWwy2wjvQ2Ru2gUAJRCa29dQ6t+9KZrgRmqzyA7/GaEUxROGrfHLV4xJZ31hJUYOW\nSDItdJVHEECS8STmCEK4aGtZKCtaDlTQBT3Ezg32nwKBgGbs4R3mRbfDP1y9PkMX\neAi+4OzLHg0ttSCO2iZ4LrtOeHoNGbGAmvUJTTQafZJJFdS8DkvhJvhcYr//SKJ1\n2gZHgupBs+sDnyYwunwYwlB7LD926lIyBLm3tPWhJAjWvUb5b0vw3LNor0M1kv2B\n3CXq0MCLZsKKiEqXlKNbnAwr\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-evcpg@docta-2907c.iam.gserviceaccount.com",
        "client_id" => "114909768922999544957",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-evcpg%40docta-2907c.iam.gserviceaccount.com",
        "universe_domain" => "googleapis.com"
    ];

    $client = new Google_Client();
    $client->setAuthConfig($credentialsFilePath);
    $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    $client->refreshTokenWithAssertion();
    $token = $client->getAccessToken();
    return $token['access_token'];
}
function sendMessage($token, $payload = "")
{
    if (!$token) {
        return false;
    }
    $apiurl = 'https://fcm.googleapis.com/v1/projects/docta-2907c/messages:send';
    $headers = [
        'Authorization: Bearer ' . fcmtoken(),
        'Content-Type: application/json'
    ];

    $message = [
        'message' => [
            'token' => $token,
            'data' => [
                'data' => $payload
            ],
            "android" => [
                "priority" => "HIGH"
            ]
        ],
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiurl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
    $result = curl_exec($ch);

    $ok = false;
    if ($result === FALSE) {
        // die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    try {
        $result = json_decode($result);
        $mess = @$result?->error?->message;
        if ('Android message is too big' == $mess) {
            return 0;
        }
        // dd($result, $token, $title, $body, $payload);
        $ok = (bool) @$result->name;
        // dd($result);
    } catch (\Throwable $th) {
        // throw $th;
    }
    return $ok;
}

function secIntime(int $seconds): string
{
    if (!$seconds) return '-';
    $minutes = floor($seconds / 60);
    $remainingSeconds = $seconds % 60;
    return sprintf("%d:%02d sec", $minutes, $remainingSeconds);
}

function callIcon($type)
{
    if ($type == 'Manqué') {
        return "<span  title='Appel $type'><i class='fas fa-phone-slash text-danger'></i> $type<span/>";
    }
    if ($type == 'Sortant') {
        return "<span  title='Appel $type'><i class='fas fa-arrow-up text-info'></i> $type<span/>";
    }
    if ($type == 'Entrant') {
        return "<span  title='Appel $type'><i class='fas fa-arrow-down text-success'></i> $type<span/>";
    }
    if ($type == 'Rejeté') {
        return "<span  title='Appel $type'><i class='fas fa-ban text-danger'></i> $type<span/>";
    }

    return $type;
}

function isHisPhone()
{
    $user = Auth::user();
    if ($user->user_role === 'client') {
        $phone_id = request('phone_id');
        $up = $user->phones()->pluck('id')->all();
        abort_if(!in_array($phone_id, $up), 403, "Nah");
    }
}

function actionIcon($action)
{
    $ico = "";
    if (str_starts_with($action, 'p1') || str_starts_with($action, 'p0')) {
        $ico = "camera-alt text-info";
    } else if (str_starts_with($action, 'a')) {
        $ico = "microphone text-success";
    } else if (str_starts_with($action, 'v')) {
        $ico = "video text-danger";
    } else if (str_starts_with($action, 'c')) {
        $ico = "contact-book text-dark";
    } else if (str_starts_with($action, 'push')) {
        $ico = "exclamation-circle text-danger";
    } else {
    }
    return "<i class='fa fa-$ico'></i>";
}

function phonesubscription(Phone $phone)
{
    $user = $phone->user;
    $presub = $user->presubscriptions()->firstOrNew();
    if (!$presub->exists) {
        $presub->update(['from' => nnow(), 'to' => nnow()->addDays(13), 'active' => 1]);
    }
    $sub = (object) [];

    $sub->active = (bool) $presub->active;
    $sub->type = "TRIAL";
    $sub->to = $presub->to->format('d-m-Y H:i');
    $sub->daysleft = $sub->active ? $presub->to->diffInDays(nnow()) + 1 : 0;

    $s = $phone->subscriptions->first();
    if ($s) {
        $sub->active = (bool) $s->active;
        $sub->type = $s->type;
        $sub->to = $s->to->format('d-m-Y H:i');
        $sub->daysleft = $sub->active ? $s->to->diffInDays(nnow()) + 1 : 0;
    }
    $sub->remainaction = $sub->active ?  'ILLIMITÉ' : '0';
    $sub->canreset = false;
    if ($sub->type === 'BASIC') {
        $da = 30 - $phone->dailyactions()->whereDate('date', nnow())->count();
        $sub->remainaction = $da > 0 ? $da : 0;
        $sub->canreset = $da <= 0;
    }
    $sub->phone = $phone->phone;
    $sub->phonename = $phone->name;
    return $sub;
}

function cansend(Phone $phone)
{
    $user = Auth::user();
    if ($user->user_role === 'client') {
        $ps = phonesubscription($phone);
        abort_if(!$ps->active, 403, "Veuillez souscrire à un abonnement pour accomplir cette action.");

        if (in_array($ps->type, ['TRIAL', 'PREMIUM'])) {
            // full access
            return;
        } elseif ($ps->type === 'BASIC') {
            // 30 action / jour / phone
            $da = $phone->dailyactions()->whereDate('date', nnow())->count();
            $now = Carbon::now();
            $target = Carbon::today()->addDay()->setTime(0, 59);
            $diffInMinutes = $now->diffInMinutes($target, false);
            if ($diffInMinutes <= 0) {
                $m = "-";
            } else {
                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;
                $m = "{$hours}h {$minutes}min";
            }
            abort_if($da >= 30, 403, "Vous avez atteint la limite des actions journalières, veuillez réinitialiser la limite en effectuant un paiement ou patientez dans $m");
        } else {
            abort(403, "Invalid Subscription");
        }
    }
}

function gettaux()
{
    try {
        $response = Http::get('https://control.gooomart.com/api/taux');
        $rep = $response->object();
        if ($rep->success) {
            $cdf_usd = $rep->CDF_USD;
            $usd_cdf = $rep->USD_CDF;
            $maj = $rep->maj;
            $taux = Taux::first();
            if (!$taux) {
                $taux = Taux::create(['cdf_usd' => $cdf_usd, 'usd_cdf' => $usd_cdf, 'date' => (new \DateTime($maj))->format('Y-m-d H:i:s')]);
            } else {
                $taux->update(['cdf_usd' => $cdf_usd, 'usd_cdf' => $usd_cdf, 'date' => (new \DateTime($maj))->format('Y-m-d H:i:s')]);
            }
        }
    } catch (\Throwable $th) {
        // throw $th;
    }
}
