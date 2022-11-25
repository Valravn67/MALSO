<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    
    public function register(){
        return view('auth.register');
    }
    public function register_save(Request $req)
    {
        $username = $req->input('username');

        $check = DB::table('users')->where('username', $username)->first();
        if ($check)
        {
            return redirect('/register');
        }

        LoginModel::register_save($req);
            return redirect('/login');
    }
    public function login(){
        return view('auth.login');
    }

    public function simpan_login(request $req){
        $username = $req->input('username');
        $password = $req->input('password');

        $check = DB::table('users')->where('username', $username)->where('password', MD5($password))->first();
        if ($check)
        {
            $data = LoginModel::getUser($username);

            $session = $req->session();
            $session->put('auth', $data);

            $this->ensureLocalUserHasRememberToken($data);
            return $this->successResponse($data->token);

        } else {
            return redirect('/login');
        }
    }

    private function generateRememberToken($username){
        return md5($username . microtime());
    }

    private function ensureLocalUserHasRememberToken($localUser){
        $token = $localUser->token;

        if (!$localUser->token)
        {
            $token = $this->generateRememberToken($localUser->username);
            DB::table('users')
            ->where('username', $localUser->username)
            ->update([
                'token' => $token
            ]);
            $localUser->token = $token;
        }

        return $token;
    }

    private function successResponse($rememberToken){
        if (Session::has('auth-originalUrl')) {
            $url = Session::pull('auth-originalUrl');
        } else {
            $url = '/';
        }

        $response = redirect($url);
        if ($rememberToken){
            $response->withCookie(cookie()->forever('presistent-token', $rememberToken));
        }

        return $response;
    }
}


