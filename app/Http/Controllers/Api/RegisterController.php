<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $response = [];
        $validator = Validator::make($request->all(), [
            'email' => ['unique:users,email'],
        ]);

        if ($validator->fails()) {
            $response = response()->json(['message' => "Email already taken"],400);
        }
        else{
            $email = $request->email;
            
            User::create([
                'email' => $email,
                'password' => Hash::make($request->password)
            ]);

            $user['email'] = $email;
            dispatch(new SendEmailJob($user));

            $response = response()->json(['message' => "User successfully registered"],201);
        }

        return $response;
    }
}
