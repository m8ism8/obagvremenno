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
        return response()->json([
            'content' => $content,
        ]);
    }
    public function mission(){
        $content = [
            'title' => setting('mission.title'),
            'image' => env('APP_URL') . '/storage/'.setting('mission.image'),
            'text' => setting('mission.text')
        ];
        return response()->json([
            'content' => $content,
        ]);
    }
    public function brandInfo(){
        $content = [
            'title' => setting('brand-info.title'),
            'text' => setting('brand-info.text')
        ];
        return response()->json([
            'content' => $content,
        ]);
    }
    public function getNews(){
        $news_items = Sale::orderBy('created_at', 'desc')->take(4)->get();
        foreach($news_items as $news){
            $news->image = env('APP_URL').'/storage/'.$news->image;
        }
        return response()->json([
            'news' => $news_items
        ]);
    }
}
