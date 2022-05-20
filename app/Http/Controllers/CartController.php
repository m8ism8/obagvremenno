<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Mail;
use App\Mail\DeliveryMail;

use App\Models\{Cart, CartElement, DeliveryPrice, PercentBonus, User};

class CartController extends Controller
{
    protected $url_Def = 'https://securepayments.sberbank.kz/payment/rest/register.do?';

    protected $url_payment = 'https://test-epay.homebank.kz/payment/cryptopay';
    protected $url_get_token = 'https://testoauth.homebank.kz/epay2/oauth2/token';

    protected $client_id = 'test';
    protected $client_secret = 'yF587AV9Ms94qN2QShFzVR3vFnWkhjbAK3sG';
    protected $terminal_id = '67e34d63-102f-4bd1-898e-370781d0074d';

    public function test()
    {
        $data = [
            "grant_type"      => "client_credentials",
            "scope"           => "webapi usermanagement email_send verification statement statistics payment",
            "client_id"       => $this->client_id,
            "client_secret"   => $this->client_secret,
            "invoiceID"       => 100000,
            "amount"          => 100001,
            "currency"        => "KZT",
            "terminal"        => $this->terminal_id,
            "postLink"        => "https://bag.a-lux.dev/",
            "failurePostLink" => "https://bag.a-lux.dev/",

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url_get_token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch, CURLOPT_POSTFIELDS,
            http_build_query($data)
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $server_output = json_decode($server_output, true);
        curl_close($ch);

        return view('halyk.index', ['payment' => $server_output]);
    }

    public function store(Request $request)
    {
        if ($request->user_id) {
            $user    = User::find($request->user_id);
            $name    = $user->name;
            $phone   = $user->phone;
            $email   = $user->email;
            $address = $user->address;
        }

        if (!$request->spend_bonuses) {
            $bonus = $this->accrueBonuses($request->price);
        } else {
            $writeOffBonuses      = $this->writeOffBonuses($request->price, $user);
            $request->price       = $writeOffBonuses['totalSum'];
            $request->bonus_waste = $writeOffBonuses['bonuses_spent'];
        }

        $name    = $request->name ?? $name;
        $phone   = $request->phone ?? $phone;
        $email   = $request->email ?? $email;
        $address = $request->address ?? $address;
        $amount  = 0;
        $cart    = Cart::create([
                                    'user_id'         => $request->user_id ?? null,
                                    'price'           => $request->price,
                                    'bonus_waste'     => $request->bonus_waste ?? 0,
                                    'name'            => $name,
                                    'phone'           => $phone,
                                    'email'           => $email,
                                    'delivery_type'   => $request->delivery_type,
                                    'payment_type'    => $request->payment_type,
                                    'address'         => $address,
                                    'bonuses_accrued' => $bonus ?? 0,
                                    'status_id'       => 1,
                                ]);

        foreach ($request->cart_elements as $element) {
            $amount += $element['quantity'];
            CartElement::create([
                                    'product_id'             => $element['product_id'] ?? null,
                                    'constructor_element_id' => $element['constructor_element_id'] ?? null,
                                    'certificate_id'         => $element['certificate_id'] ?? null,
                                    'cart_id'                => $cart->id,
                                    'quantity'               => $element['quantity'],
                                    'price'                  => $element['price'],
                                    'title'                  => $element['title'],
                                ]);
        }

        if ($cart['payment_type'] == "card") {
            $auth = $this->getToken($cart);
//            $cart->update([
//                              'payment_id' => $payment['orderId'],
//                          ]);
            return [
                'auth'    => $auth,
                'payment' => [
                    'invoiceID' => $cart->id + 100000,
                    'amount'    => $cart->price,
                    'terminal'  => $this->terminal_id,
                ],
                'cart'    => $cart,
            ];
        }

        try {
            \Mail::to($email)
                 ->send(new DeliveryMail($cart))
            ;
        } catch (\Throwable $e) {
        }

        $cart->update([
                          'payment_status' => 'Оплата при получении',
                      ]);

        return response()->json([
                                    'cart' => $cart,
                                ]);
    }

    public function deliveryPrice()
    {
        $price = DeliveryPrice::query()
                              ->select('price')
                              ->first()
        ;

        return response()->json($price);
    }

    protected function accrueBonuses($sum)
    {
        $percent = PercentBonus::query()
                               ->first()
        ;

        return ($sum * ($percent->percent / 100));
    }

    protected function writeOffBonuses($sum, $user): array
    {
        $userBonus = $user->bonus;
        $totalSum  = $sum - $userBonus;

        if ($totalSum < 0) {
            $totalSum     = 0;
            $currentBonus = $userBonus - $sum;
            $bonusesSpent = $sum;
        } else {
            $currentBonus = 0;
            $bonusesSpent = $sum - $totalSum;
        }
        User::query()
            ->find($user->id)
            ->update([
                         'bonus' => $currentBonus,
                     ])
        ;

        return [
            'totalSum'      => $totalSum,
            'bonuses_spent' => $bonusesSpent,
        ];
    }

//    protected function onlinePayment($cart)
//    {
//        $token = $this->getToken();
//        return $token;
//        $data = [
//            "grant_type"    => "client_credentials",
//            "scope"         => "webapi usermanagement email_send verification statement statistics payment",
//            "client_id"     => $this->client_id,
//            "client_secret" => $this->client_secret,
//        ];
//
//        $ch = curl_init();
//
//        curl_setopt($ch, CURLOPT_URL, $this->url_payment);
//
//        curl_setopt($ch, CURLOPT_POST, 1);
//        curl_setopt(
//            $ch, CURLOPT_POSTFIELDS,
//            http_build_query($data)
//        );
//
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//        $server_output = curl_exec($ch);
//        $server_output = json_decode($server_output);
//        curl_close($ch);
//
//        return $server_output->access_token;
//    }

    protected function getToken($cart)
    {
        $data = [
            "grant_type"      => "client_credentials",
            "scope"           => "webapi usermanagement email_send verification statement statistics payment",
            "client_id"       => $this->client_id,
            "client_secret"   => $this->client_secret,
            "invoiceID"       => $cart->id + 100000,
            "amount"          => $cart->price,
            "currency"        => "KZT",
            "terminal"        => $this->terminal_id,
            "postLink"        => "https://bag.a-lux.dev/",
            "failurePostLink" => "https://bag.a-lux.dev/",

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url_get_token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
            $ch, CURLOPT_POSTFIELDS,
            http_build_query($data)
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $server_output = json_decode($server_output, true);
        curl_close($ch);

        return $server_output;
    }

    public function checkPayment()
    {
        $carts = Cart::query()
                     ->where('payment_status', 'В обработке')
                     ->get()
        ;

        foreach ($carts as $cart) {
            $status = self::checkRequest($cart->payment_id);
            if ($status['orderStatus'] == 2) {
                $cart->update([
                                  'status' => 'Оплачен',
                              ]);
            } elseif ($status['orderStatus'] == 0) {
                $cart->update([
                                  'status' => 'В обработке',
                              ]);
            } else {
                $cart->update([
                                  'status' => 'Отказано в оплате',
                              ]);
            }
        }
    }

    protected function checkRequest($orderId)
    {
        $attributes['userName'] = 'obagoffical-api';
        $attributes['password'] = 'obagofficalOperator123/';
        $attributes['orderId']  = $orderId;

        $ch = curl_init($this->url_Def . http_build_query($attributes));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return json_decode($res, true);
    }
}
