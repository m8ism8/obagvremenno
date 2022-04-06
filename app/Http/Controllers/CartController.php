<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Mail;
use App\Mail\DeliveryMail;

use App\Models\{Cart, CartElement, DeliveryPrice, PercentBonus, User};

class CartController extends Controller
{
    protected $url_Def = 'https://securepayments.sberbank.kz/payment/rest/register.do?';

    public function store(Request $request)
    {
        if($request->user_id){
            $user = User::find($request->user_id);
            $name = $user->name;
            $phone = $user->phone;
            $email = $user->email;
            $address = $user->address;
        }

        if (!$request->spend_bonuses) {
            $bonus = $this->accrueBonuses($request->price);
        } else {
            $writeOffBonuses = $this->writeOffBonuses($request->price, $user);
            $request->price        = $writeOffBonuses['totalSum'];
            $request->bonus_waste  = $writeOffBonuses['bonuses_spent'];
        }

        $name = $request->name ?? $name;
        $phone = $request->phone ?? $phone;
        $email = $request->email ?? $email;
        $address = $request->address ?? $address;

        $cart = Cart::create([
            'user_id' => $request->user_id ?? null,
            'price' => $request->price,
            'bonus_waste' => $request->bonus_waste ?? 0,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'delivery_type' => $request->delivery_type,
            'payment_type' => $request->payment_type,
            'address' => $address,
            'bonuses_accrued' => $bonus ?? 0,
            'status_id'          => 1
        ]);

        foreach($request->cart_elements as $element) {
            CartElement::create([
                'product_id' => $element['product_id'] ?? null,
                'constructor_element_id' => $element['constructor_element_id'] ?? null,
                'certificate_id' => $element['certificate_id'] ?? null,
                'cart_id' => $cart->id,
                'quantity' => $element['quantity'],
                'price' => $element['price'],
                'title' => $element['title'],
            ]);
        }

        if ($cart['payment_type'] == "card") {
            $payment = $this->onlinePayment($cart);
            $cart->update([
                'payment_id' => $payment['orderId']
            ]);
            return [
                'payment'     => $this->onlinePayment($cart),
                'cart'        => $cart
            ];
        }

        try {
            \Mail::to($email)->send(new DeliveryMail($cart));
        }
        catch (\Throwable $e){
        }

        $cart->update([
            'payment_status' => 'Оплата при получении'
        ]);
        return response()->json([
            'cart' => $cart,
        ]);
    }
    public function deliveryPrice()
    {
        $price = DeliveryPrice::query()->select('price')->first();
        return response()->json($price);
    }
    protected function accrueBonuses($sum)
    {
        $percent  = PercentBonus::query()->first();
        return ($sum * ($percent->percent / 100));
    }

    protected function writeOffBonuses($sum, $user): array
    {
        $userBonus = $user->bonus;
        $totalSum = $sum - $userBonus;

        if ($totalSum < 0) {
            $totalSum = 0;
            $currentBonus = $userBonus - $sum;
            $bonusesSpent = $sum;
        } else {
            $currentBonus = 0;
            $bonusesSpent = $sum - $totalSum;
        }
        User::query()->find($user->id)->update([
            'bonus' => $currentBonus
        ]);
        return [
            'totalSum'      => $totalSum,
            'bonuses_spent' => $bonusesSpent
        ];
    }


    protected function onlinePayment($cart)
    {
        $attributes = [];

        $attributes['userName'] = 'obagoffical-api';
        $attributes['password'] = 'obagofficalOperator123/';

        $orderId = $cart->id . Str::random(14);
        $totalSum = $cart->price;

        $attributes['amount'] = $totalSum * 100;
        $attributes['orderNumber'] = $orderId;

        $attributes['returnUrl'] = 'https://aptekadom.kz/account/history';
        $attributes['failUrl'] = 'https://obagnew.a-lux.dev/';
        $attributes['description'] = 'Заказ №' . $orderId . ' на ' . env('APP_URL');



        $ch = curl_init($this->url_Def . http_build_query($attributes));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }

    public function checkPayment()
    {
        $carts = Cart::query()
            ->where('payment_status', 'В обработке')
            ->get();

        foreach ($carts as $cart) {
            $status = self::checkRequest($cart->payment_id);
            if ($status['orderStatus'] == 2) {
                $cart->update([
                    'status' => 'Оплачен'
                ]);
            } elseif ($status['orderStatus'] == 0) {
                $cart->update([
                    'status' => 'В обработке'
                ]);
            } else {
                $cart->update([
                    'status' => 'Отказано в оплате'
                ]);
            }
        }
    }

    protected function checkRequest($orderId)
    {
        $attributes['userName'] = 'obagoffical-api';
        $attributes['password'] = 'obagofficalOperator123/';
        $attributes['orderId'] = $orderId;

        $ch = curl_init($this->url_Def . http_build_query($attributes));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }


}
