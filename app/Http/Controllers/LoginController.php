<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\User;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Process login for users
     *
     * @since 1.0
     *
     * @version 1.0.0
     *
     * @param App\Http\Requests\LoginRequest $request A Request object
     *
     * @return json string
     */
    public function login(LoginRequest $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        $key = env("JWT_KEY", "salt");

        $user = User::where('username', $username)->first();
        if ($user && Hash::check($password, $user->password)) {
            //create JWT token
            $data = array(
                "user_id" => $user->id,
                "name" => $user->name
            );
            $token = JWT::encode($data, $key);
            $data = ["token" => $token, "status" => Response::HTTP_OK];
        } else {
            $data = ["error" => "Invalid username/password", "status" => Response::HTTP_OK];
        }
        return $data;
    }
}
