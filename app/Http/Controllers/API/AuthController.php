<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user || !Hash::check($request->password, $user->password) ) {
            return response()->json([
                'status' => 401,
                'message' => 'Kamu belum registrasi / password salah!'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Sukses login',
                'data_user' => $user,
                'token' => $user->createToken($request->password)->plainTextToken
            ]);
        };
    }
}
