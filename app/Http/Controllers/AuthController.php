<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Laravel\Socialite\Facades\Socialite;
use App\Models\{
    User,
    Favourite,
    Product,
    Review,
    Mail,
};

use App\Http\Resources\{
    ProductResource,
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
                'message' => 'Пользователяс таким номером телефона нет, или пароль не подходит'
            ], 401);
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
        $ids = Auth()->user()->favourites->pluck('product_id');
        $ids_ordered = $ids->join(',');
        $products = Product::wherein('id', $ids)->orderByRaw("FIELD(id, $ids_ordered)")->get();
        return response()->json([
            'products' => ProductResource::collection($products),
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
                'address' => $request->address ?? $user->address,
                'date_of_birth' => $request->date_of_birth ?? $user->date_of_birth
            ]);
            $message = 'Данные изменены';
        }
        return response()->json([
            'message' => $message,
        ]);
    }
    public function user(){
        return response()->json([
            'user' => auth()->user()
        ]);
    }
    public function history(){
        $user = auth()->user();
        $carts = $user->carts;
        foreach($carts as $cart){
            $cart->elements;
        }
        return response()->json([
            'carts' => $carts,
        ]);
    }
    public function review($id, Request $request){
        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $id,
            'rating' => $request->rating,
            'text' => $request->text ?? null,
        ]);
        return response()->json([
            'message' => 'Отзыв отправлен на модерацию'
        ]);
    }
    public function getProducts(){
        $user = User::find(auth()->id());
        $user->cartElements;
        $product_ids = $user->cartElements->pluck('product_id')->unique()->diff([null]);
        return response()->json([
            'product_ids' => $product_ids
        ]);
    }
    public function subscribe(){
        $user = User::find(auth()->id());
        $mail = Mail::where('mail', $user->email)->first();
        if($mail) $message = 'Вы уже подписаны на рассылку новостей';
        else {
        Mail::create([
            'mail' => $user->email
        ]);
        $message = 'Успешно подписались на рассылку';
        }
        return response()->json([
            'message' => $message,
        ]);
    }


    public function googleRegister()
    {
        return \response()->json([
            'url' => Socialite::driver('google')->redirect()->getTargetUrl()
        ]);
    }

    public function googleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $existingUser = User::where('email', $user->email)->first();

        //TODO как то отдавать досу
        if($existingUser){
            // log them in
            Auth::login($existingUser);
        } else {
            // create a new user
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id
            ]);
            Auth::login($newUser);
        }
        return redirect()->to('/');

    }
}
