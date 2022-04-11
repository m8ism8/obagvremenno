<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\City;

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
        $news_items = Sale::query()
            ->select(
                'id',
                        'title',
                        'subtitle',
                        'badge',
                        'image',
                        'text',
                        'created_at'
            )
            ->orderBy('created_at', 'desc')
            ->get();
        foreach($news_items as $news){
            $news->image = env('APP_URL').'/storage/'.$news->image;
        }
        return response()->json([
            'news' => $news_items
        ]);
    }

    public function new(int $id)
    {
        $article = Sale::query()->find($id);
        if ($article == null) {
            return response()->json([
                'message' => 'Страница не найдена'
            ],404);
        }
        $article->image = env('APP_URL').'/storage/'.$article->image;

        $images = json_decode($article->images);
        if ($images != null) {
            $newImages = [];

            foreach ($images as $image) {
                $image = env('APP_URL').'/storage/' . $image;
                $newImages[] = $image;
            }
            $article->images = $newImages;
        }

        $images = json_decode($article->second_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->second_images = $newImages;
        }


        $images = json_decode($article->third_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->third_images = $newImages;
        }

        return response()->json($article);
    }

    public function getCities(){
        $cities = City::with('fillials')->get();
        return response()->json([
            'cities' => $cities
        ]);
    }
}
