<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\{
    User,
    Favourite,
};

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string|unique:users,phone'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone' => $fields['phone']
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function login(Request $request){
        $fields = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('phone', $fields['phone'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'message' => 'Bad creds'
            ]);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'logged out'
        ]);
    }
    public function favourites(){
        return response()->json([
            'favourites' => Auth()->user()->favourites,
        ]);
    }
    public function edit(Request $request){
        $user = User::find(auth()->id());
        $userEmail = User::where('id', $user->id)->first();
        if($userEmail && $user != $userEmail) $message = 'Пользователь с данной почтой уже существует';
        else {
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
            ]);
            $message = 'Данные изменены';
        }
        return response()->json([
            'message' => $message,
        ]);
    }
}
