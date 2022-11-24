<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    public static function register_save($req)
    {
        $token = md5($req->input('username') . microtime());
        DB::table('users')->insert([
            'username' => $req->input('username'),
            'password' => md5($req->input('password')),
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    public static function getUser($username){
        return DB::table('users')->get()
            ->first();
    }
}
