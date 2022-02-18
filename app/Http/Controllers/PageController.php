<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function history(Request $request){
        $language = $request->header('accept-language');
        $content = [
            'title' => setting('history-'.$language.'.title'),
            'image' => setting('history-'.$language.'.image'),
            'text' => setting('history-'.$language.'.text')
        ];
        return response()->json([
            'content' => $content,
        ]);
    }
}
