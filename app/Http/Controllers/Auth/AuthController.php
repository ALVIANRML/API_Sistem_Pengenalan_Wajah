<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function Register(Request $request)
  {
    $validatedData = Validator::make($request->all(),[
        'name'      => 'required|max:100',
        'email'     => 'required|email:dns|unique:users',
        'password'  => 'required|min:3',
    ]);
    if ($validatedData->fails()){
        return response()->json([
            'success'   => false,
            'message'   => 'email sudah digunakan',
            'data'      => $validatedData -> errors(),
            'code'      => 422
        ]);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password)
    ]);

    if ($user){
        return response()->json([
            'success' => true,
            'message' => 'registrasi berhasil',
            'user'    => $user,
            'code'    => 200,

        ]);
    }
    return response()->json([
        'success'   => false,
        'code'      => 404,
    ]);
    }

    public function Login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
            'message'   => 'Password atau email salah',
            'code'      => 404,
        ]);
        }
        $token = $user->createToken($user->id)->accessToken;
        return response()->json([
            'code'      => 200,
            'message'   => [
                'user' => $user,
                'token'=> $token,
            ],
        ]);
    }
}
