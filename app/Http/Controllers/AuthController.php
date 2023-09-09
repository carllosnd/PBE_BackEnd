<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        $username = $request->server('PHP_AUTH_USER');
        $password = $request->server('PHP_AUTH_PW');
        $user = User::query()->where('username', $username)->first();
        #jika usernya ada atau tidak
        if ($user === null) {
            return response()->json([
                'message' => 'Periksa kembali username dan password'
            ], 400);
        }
        #kondisi username ada
        #cek apakah password benar
        if (password_verify($password, $user->password) === false) {
            return response()->json([
                'message' => 'Periksa kembali username dan password'
            ], 400);
        }
        #kondisi bahwa username dan password benar
        #buat token
        $token = Uuid::uuid6()->toString();
        #simpan ke user token
        $userToken = new UserToken();
        $userToken->token = $token;
        $userToken->expired = Carbon::now()->addDays(1)->format('Y-m-d H:i:s');
        $userToken->id_user = $user->id;
        $userToken->save();
        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $userToken
            ]
        ], 200);
    }

}
