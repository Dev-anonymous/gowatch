<?php

namespace App\Http\Middleware\app;

use App\Models\HttpToken;
use App\Models\Phone;
use Closure;
use Illuminate\Http\Request;

class AppMiddleware
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
        $at = request()->header('x-app-token');
        abort_if(!$at, 403, "Nah");
        $token = HttpToken::where('token', $at)->first();
        if (!$token) {
            $phone = Phone::where('token', $at)->first(); // on a supprimer le token dans la table token alors que c'etait deja envoye au phone
            abort_if(!$phone, 403, "Nahaa !"); // not connected
            $token =HttpToken::create(['token' => $at, 'users_id' => $phone->user->id, 'date' => nnow()]);
        }
        $phone = Phone::where('token', $token->token)->firstOrNew();
        if (!$phone->exists) { 
            $phone->users_id = $token->users_id;
            $phone->token = $token->token;
        }
        $phone->updatedon = nnow();
        $phone->save();

        return $next($request);
    }
}
