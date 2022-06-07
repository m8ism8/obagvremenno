<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacanciesRequest;
use App\Mail\OrderOneClickMail;
use Illuminate\Http\Request;

use App\Models\{Callback, NotifyProduct, OrderCallback, Product, SendMail, Vacancy};
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class CallBackController extends Controller
{
    public function notify(Request $request)
    {
        $fields = $request->validate([
                                         'product_id' => 'required|integer',
                                         'email'      => 'required|string',
                                     ]);

        NotifyProduct::query()
                     ->create($fields)
        ;

        return response()->json(['message' => 'done.']);
    }

    public function callback(Request $request)
    {
        $fields = $request->validate([
                                         'name'    => 'required|string',
                                         'surname' => 'required|string',
                                         'email'   => 'required|string',
                                         'phone'   => 'required|string',
                                         'text'    => 'required|string',
                                     ]);
        CallBack::create($fields);

        return response()->json(['message' => 'done.']);
    }

    public function order(Request $request): \Illuminate\Http\JsonResponse
    {
        $fields = $request->validate([
                                         'name'       => 'required|string',
                                         'phone'      => 'required|string',
                                         'product_id' => 'required|integer',
                                     ]);
        try {
            $mail    = SendMail::query()
                               ->first()->order_one_click;
            $product = Product::query()
                              ->where('id', $fields['product_id'])
                              ->first()
            ;

            Mail::to($mail)
                ->send(
                    new OrderOneClickMail($fields, $product)
                )
            ;

            OrderCallback::query()
                         ->create($fields)
            ;
        } catch (\Exception $exception) {
            return \response()->json([
                                         'message' => $exception->getMessage(),
                                     ], 409);
        }

        return response()->json(['message' => 'Операция прошла успешно']);

    }


    public function vacancies(Request $request)
    {
        $fields = [
            'name'    => $request->name,
            'surname' => $request->surname ?? '',
            'email'   => $request->email,
            'phone'   => $request->phone,
            'text'    => $request->text ?? '',
            'file'    => $request->file ?? '',
        ];
        try {
            if (!empty($fields['file'])) {
                $file           = $request->file('file')
                                          ->store('/vacancies')
                ;
                $fields['file'] = $file;
            } else {
                $fields['file'] = 0;
            }
        } catch (\Exception $exception) {
            return response()->json("Ошибка при загрузки файла", Response::HTTP_I_AM_A_TEAPOT);
        }
        try {
            Vacancy::query()
                   ->create($fields)
            ;
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 422);
        }

        return response()->json(['message' => 'Операция прошла успешно']);

    }
}
