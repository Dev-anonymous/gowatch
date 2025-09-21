<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\Remotecontrol;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class RemoteControlAPIController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phone_id = request('phone_id');
        $data = Remotecontrol::where(compact('phone_id'))->orderBy('id', 'desc')->get();
        $tab = [];

        foreach ($data as $el) {
            $o = (object) [];
            $o->id = $el->id;
            $o->action = $el->action;
            $st = $el->fetched;
            if ($st == 0) {
                $o->status = "En attente";
            } elseif ($el->success) {
                $o->status = "OK";
            } else {
                $o->status = "Echec";
            }
            $o->date = $el->date->format('d-m-Y H:i:s');
            $o->fetchedon = $el->fetchedon?->format('d-m-Y H:i:s') ?? '-';
            $o->errormessage = $el->errormessage;
            $r = $el->result;
            if ($r) {
                $hr = asset('storage/' . $r);
                $r0 = explode('/', $r);
                $r0 = end($r0);
                $o->result = "<a href='$hr' target='_blank'> $r0</a>";
            } else {
                $o->result = '';
            }
            $tab[] = $o;
        }

        $phones = [];
        foreach (Phone::orderBy('updatedon', 'desc')->get() as $el) {
            $phones[] = (object)[
                'id' => $el->id,
                'phone' => $el->phone,
                'data' => json_decode($el->data),
                'updatedon' => $el->updatedon?->format('d-m-Y H:i:s'),
                'perms' => json_decode($el->perms),
            ];
        }

        $data = [];
        $data['phones'] = $phones;
        $data['actions'] = $tab;
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $phone_id = request('phone_id');
        if (!$phone_id) {
            abort(422, "Phone est required");
        }
        $action = request('action');
        $action2 = request('action2');
        if ($action2) {
            $action = $action2;
        }

        // if (in_array($action, ['p1.0', 'p1.1', 'p0.0', 'p0.1', 'c'])) {
        $rem = Remotecontrol::create([
            'phone_id' => $phone_id,
            'action' => $action,
            'success' => 0,
            'fetched' => 0,
            'fromadmin' => 0,
            'date' => nnow(),
        ]);
        $phone = $rem->phone;
        if ($phone->fcm) {
            $cmd = "$rem->id.$action";
            try {
                sendMessage($phone->fcm, $cmd);
            } catch (\Throwable $th) {
            }
        }

        return $this->success("Commande envoyée");
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Remotecontrol  $remotecontrol
     * @return \Illuminate\Http\Response
     */
    public function show(Remotecontrol $remotecontrol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Remotecontrol  $remotecontrol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Remotecontrol $remotecontrol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Remotecontrol  $remotecontrol
     * @return \Illuminate\Http\Response
     */
    public function destroy(Remotecontrol $remotecontrol)
    {
        //
    }
}
