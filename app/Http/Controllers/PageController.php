<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Sale;

class PageController extends Controller
{
    public function history(){
        $content = [
            'title' => setting('history.title'),
            'image' => env('APP_URL') . '/storage/'.setting('history.image'),
            'text' => setting('history.text')
        ];
        $news = Sale::orderBy('created_at', 'desc')->take(4)->get();
        return response()->json([
            'content' => $content,
            'news' => $news
        ]);
    }
    public function mission(){
        $content = [
            'title' => setting('mission.title'),
            'image' => env('APP_URL') . '/storage/'.setting('mission.image'),
            'text' => setting('mission.text')
        ];
        $news = Sale::orderBy('created_at', 'desc')->take(4)->get();
        return response()->json([
            'content' => $content,
            'news' => $news
        ]);
    }
}
