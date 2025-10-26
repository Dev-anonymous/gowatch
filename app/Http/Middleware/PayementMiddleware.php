<?php

namespace App\Http\Middleware;

use App\Models\App;
use App\Models\Balance;
use App\Models\Call;
use App\Models\Callrecorder;
use App\Models\Gopay;
use App\Models\Keylogger;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Phone;
use App\Models\Remotecontrol;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PayementMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $mindate = Carbon::now()->subDays(6);
        // App::where('date', '<', $mindate)->delete();
        Keylogger::where('date', '<', $mindate)->delete();
        Call::where('date', '<', $mindate)->delete();
        Location::where('date', '<', $mindate)->delete();
        Notification::where('date', '<', $mindate)->delete();
        $rem = Remotecontrol::where('date', '<', $mindate);
        foreach ($rem as $el) {
            File::delete("storage/" . $el->result);
            $el->update(['result' => null]);
        }

        $rem = Callrecorder::where('date', '<', $mindate);
        foreach ($rem as $el) {
            File::delete("storage/" . $el->path);
            $el->delete();
        }

        DB::beginTransaction();

        $u = User::whereHas('phones')->get();
        foreach ($u as $el) {
            $e = $el->presubscriptions()->first();
            if ($e) {
                $to = $e->to;
                if ($to->lt(nnow())) {
                    $e->active = 0;
                } else {
                    $e->active = 1;
                }
                $e->save();
            } else {
                $el->presubscriptions()->create(['to' => nnow()->addDays(13), 'active' => 1]);
            }
        }

        $sub = Subscription::get();
        foreach ($sub as $e) {
            $to = $e->to;
            if ($to->lt(nnow())) {
                $e->active = 0;
            } else {
                $e->active = 1;
            }
            $e->save();
        }

        $u = User::whereDoesntHave('balances')->where('user_role', 'client')->get();
        foreach ($u as $el) {
            Balance::create(['users_id' => $el->id, 'amount' => 0, 'currency' => 'CDF']);
            Balance::create(['users_id' => $el->id, 'amount' => 0, 'currency' => 'USD']);
        }
        DB::commit();

        $mindate = Carbon::now()->subHours(6);
        Gopay::where('date', '<', $mindate)->where('issaved', 0)->update(['isfailed' => 1]);

        completeTrans();
        Artisan::call('sendmail');

        return $next($request);
    }
}
