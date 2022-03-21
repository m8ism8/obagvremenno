<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{Callback, Mail, OrderCallback, Vacancy};

class CallBackController extends Controller
{
    public function callback(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string',
            'phone' => 'required|string',
            'text' => 'required|string',
        ]);
        CallBack::create($fields);
        return response()->json(['message' => 'done.']);
    }

    public function order(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);
        try {
        OrderCallback::query()
            ->create($fields);
        } catch (\Exception $exception) {
            return \response()->json([
                'message' => $exception->getMessage()
            ], 409);
        }
        return response()->json(['message' => 'Операция прошла успешно']);

    }
}
