<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{


    public function login(Request $request)
    {

        $credentials = $request->only(['email', 'password']);
        //        dd(Auth::attempt($credentials));

        if (Auth::attempt($credentials)) {
            //            dd(Auth::attempt($credentials));
            // Login success, redirect to admin dashboard
            return redirect()->route('admin.home');
        }

        // Login failed
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    //    public function login(Request $request)
    //    {
    //        $credentials = $request->only(['email', 'password']);
    //
    //        if (!$token = JWTAuth::attempt($credentials)) {
    //            return response()->json(['status' => false, 'message' => 'Invalid Credentials'], 401);
    //        }
    //
    ////        return response()->json([
    ////            'status' => true,
    ////            'token' => $token,
    ////            'user' => auth()->user(),
    ////        ]);
    //        return redirect()->route('admin.home');
    //    }

    public function loginForm()
    {
        return view('admin.login');
    }

    public function logout()
    {
        auth()->logout();
        return view('admin.layout.logout');
        //        return response()->json(['status' => true, 'message' => 'Successfully logged out']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }
}
