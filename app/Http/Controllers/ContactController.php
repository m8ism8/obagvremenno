<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\FeedbackMail;
use App\Models\ContactFeedback;
use App\Models\ContactInfo;
use App\Models\SendMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    public function index(): JsonResponse
    {
        $contact = ContactInfo::query()
                              ->first()
        ;

        return response()->json($contact);
    }

    public function create(ContactRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();
        try {
            $mail = SendMail::query()
                            ->first()->feedback;

            Mail::to($mail)
                ->send(
                    new FeedbackMail($data)
                )
            ;

            ContactFeedback::query()
                           ->create($data)
            ;

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json([
                                        'message' => $exception->getMessage(),
                                    ], Response::HTTP_CONFLICT);
        }

        return response()->json([
                                    'message' => 'Операция прошла успешно',
                                ], Response::HTTP_OK);
    }
}
