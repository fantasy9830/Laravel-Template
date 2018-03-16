<?php

namespace App\Auth\Controllers;

use ApiAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function postSign(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Authenticating against LDAP server.
        if (ApiAuth::login($username, $password)) {
            // Passed!
            $token = ApiAuth::createToken($username);

            return response()->json([
                'token' => $token
            ]);
        } else {
            return abort(401, 'Username or password is incorrect.');
        }
    }
}
