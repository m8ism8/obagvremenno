<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function history(Request $request){
        $language = $request->header('accept-language');
        $content = [
            'title' => setting('history.title'),
            'image' => env('APP_URL') . '/storage/'.setting('history.image'),
            'text' => setting('history.text')
        ];
        return response()->json([
            'content' => $content
        ]);
    }
}
