<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\{
    Cart,
    CartElement,
};

class CartController extends Controller
{
    public function store(Request $request){
        if(Auth::check()){
            $user = auth()->user();
            $user_id = $user->id;
            $name = $user->name;
            $phone = $user->phone;
            $email = $user->email;
        }
        else {
            $user_id = null;
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
        }
        $cart = Cart::create([
            'user_id' => $user_id,
            'price' => $request->price,
            'bonus_waste' => $request->bonus_waste,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'delivery_type' => $request->delivery_type,
            'payment_type' => $request->payment_type
        ]);
        foreach($request->cart_elements as $element) {
            CartElement::create([
                'product_id' => $element['product_id'] ?? null,
                'constructor_element_id' => $element['constructor_element_id'] ?? null,
                'certificate_id' => $element['certificate_id'] ?? null,
                'cart_id' => $cart->id,
                'quantity' => $element['quantity'],
                'price' => $element['price'],
                'title' => $element['title']
            ]);
        }
        $cart->elements;
        return response()->json([
            'cart' => $cart,
        ]);
    }
}
