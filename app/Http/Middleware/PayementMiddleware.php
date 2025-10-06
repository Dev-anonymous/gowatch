<?php

namespace App\Http\Middleware;

use App\Models\App;
use App\Models\Call;
use App\Models\Keylogger;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Remotecontrol;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        $mindate = Carbon::now()->subDays(7);
        App::where('date', '<', $mindate)->delete();
        Keylogger::where('date', '<', $mindate)->delete();
        Call::where('date', '<', $mindate)->delete();
        Location::where('date', '<', $mindate)->delete();
        Notification::where('date', '<', $mindate)->delete();
        Remotecontrol::where('date', '<', $mindate)->delete();

        return $next($request);
    }
}
