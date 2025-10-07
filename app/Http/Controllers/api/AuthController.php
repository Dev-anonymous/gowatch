<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\AppMail;
use App\Models\HttpToken;
use App\Models\Pendinguser;
use App\Models\Token;
use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {
        if (!User::where('user_role', 'admin')->first()) {
            User::create(['name' => 'Admin', 'email' => 'admin@admin.admin', 'password' => Hash::make('admin1001'), 'user_role' => 'admin']);
        }
        if (!User::where('user_role', 'client')->first()) {
            User::create(['name' => 'Test User', 'email' => 'user@user.user', 'password' => Hash::make('user'), 'user_role' => 'client']);
        }

        $attr = $request->all();
        $validator = Validator::make($attr, [
            'login' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error(implode(' ', $validator->errors()->all()));
        }

        $success = false;
        $data = $validator->validate();
        $login = $data['login'];
        $_ = ['password' => $data['password'], 'email' => $login];
        if (Auth::attempt($_, request('remember') ? true : false)) {
            $success = true;
        }

        if (!$success) {
            return $this->error('Email ou mot de passe incorrecte.');
        }
        $user = auth()->user();
        $user->update(['derniere_connexion' => nnow()]);

        $data = [];
        $data['role'] =  $user->user_role;
        if (request()->has('isapp')) {
            $data['apptoken'] = $t = makeRand(15);
            HttpToken::create(['users_id' => $user->id, 'token' => $t, 'date' => nnow()]);
        } else {
            $data['token'] = $user->createToken('token_' . time())->plainTextToken;
        }
        return $this->success("Bienvenue $user->name", $data);
    }

    function newuser()
    {
        $attr = request()->all();
        $validator = Validator::make($attr, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error(implode(' ', $validator->errors()->all()));
        }
        $data = $validator->validated();
        $data['name'] = ucfirst($data['name']);
        $data['email'] = strtolower($data['email']);
        $un = $data['name'];

        $pend = Pendinguser::where('email', $data['email'])->firstOrNew();
        if (!$pend->exists) {
            $pend->token = makeRand(20);
            $pend->data = json_encode($data);
            $pend->email = $data['email'];
            $pend->date = nnow();
            $pend->save();
        }

        $href = route('confirmemail.web', ['token' => $pend->token]);
        $link = "<a href='$href'>Confirmer mon email</a>";
        try {
            $mail = "Bienvenue $un, veuillez cliquer sur le lien ci-dessous pour confirmer votre compte : $href";
            Mail::to($data['email'])->send(new AppMail((object)['subject' => "Confirmation du compte", 'msg' => $mail]));
            return $this->success("Veuillez cliquer sur le lien que nous avons envoyé à  votre email.");
        } catch (\Throwable $th) {
            throw $th;
            return $this->success("Une petie erreur s'est produite, veuillez réessayer.");
        }
    }

    public function logout(Request $r)
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user **/
            $user = auth()->user();
            Auth::guard('web')->logout();
        }
        return redirect(route('app.login'));
    }
}
