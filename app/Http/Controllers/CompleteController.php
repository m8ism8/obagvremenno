<?php

namespace App\Http\Controllers;


use App\Models\CompleteCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function index(int $id): JsonResponse
    {
        $completes = CompleteCategory::query()
                                    ->where('subcategory_id', $id)
                                    ->get();

        foreach ($completes as $complete) {
            $complete->image = env('APP_URL').'/storage/'.$complete->image;
        }

        return response()->json($completes);
    }

    public function show(int $id)
    {

    }
}
