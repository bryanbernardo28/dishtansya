<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('throttle:2,1')->only('login'); 
    }

    
    public function login(Request $request)
    {
        $response = [];
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            $response = response()->json(['message' => "Invalid credentials"],401);
        }
        else{
            $token = $user->createToken($request->email)->plainTextToken;
            $response = response()->json(['access_token' => $token],201);
        }
        
        return $response;
    }
}
