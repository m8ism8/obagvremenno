<?php

namespace App\Http\Controllers;

use App\Models\NewSales;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\City;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function sales()
    {
        $news_items = NewSales::query()
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
                              ->get()
                              ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($news_items as $news) {
            if ($news->translations->isEmpty()) {
                $news = $news->translate('ru');
            }
            $news->slug  = Str::slug($news->title);
            $news->image = env('APP_URL') . '/storage/' . $news->image;
        }

        return response()->json([
                                    'news' => $news_items,
                                ]);
    }

    public function salesById(int $id)
    {
        $article = NewSales::query()
                           ->find($id)
                           ->translate(\request()->header('Accept-Language'))
        ;

        if ($article->translations->isEmpty()) {
            $article = $article->translate('ru');
        }

        if ($article == null) {
            return response()->json([
                                        'message' => 'Страница не найдена',
                                    ], 404);
        }
        $article->image = env('APP_URL') . '/storage/' . $article->image;

        $images = json_decode($article->images);
        if ($images != null) {
            $newImages = [];

            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->images = $newImages;
        }

        $images = json_decode($article->second_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->second_images = $newImages;
        }


        $images = json_decode($article->third_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->third_images = $newImages;
        }

        return response()->json($article);
    }

    public function history()
    {
        $content = [
            'title' => setting('history.title'),
            'image' => env('APP_URL') . '/storage/' . setting('history.image'),
            'text'  => setting('history.text'),
        ];

        return response()->json([
                                    'content' => $content,
                                ]);
    }

    public function mission()
    {
        $content = [
            'title' => setting('mission.title'),
            'image' => env('APP_URL') . '/storage/' . setting('mission.image'),
            'text'  => setting('mission.text'),
        ];

        return response()->json([
                                    'content' => $content,
                                ]);
    }

    public function brandInfo()
    {
        $content = [
            'title' => setting('brand-info.title'),
            'text'  => setting('brand-info.text'),
        ];

        return response()->json([
                                    'content' => $content,
                                ]);
    }

    public function getNews()
    {
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
                          ->get()
                          ->translate(\request()->header('Accept-Language'))
        ;


        foreach ($news_items as $news) {
            if ($news->translations->isEmpty()) {
                $news = $news->translate('ru');
            }
            $news->image = env('APP_URL') . '/storage/' . $news->image;
        }

        return response()->json([
                                    'news' => $news_items,
                                ]);
    }

    public function new(int $id)
    {
        $article = Sale::query()
                       ->find($id)
                       ->translate(\request()->header('Accept-Language'))
        ;

        if ($article == null) {
            return response()->json([
                                        'message' => 'Страница не найдена',
                                    ], 404);
        }
        if ($article->translations->isEmpty()) {
            $article = $article->translate('ru');
        }
        $article->image = env('APP_URL') . '/storage/' . $article->image;

        $images = json_decode($article->images);
        if ($images != null) {
            $newImages = [];

            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->images = $newImages;
        }

        $images = json_decode($article->second_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->second_images = $newImages;
        }


        $images = json_decode($article->third_images);
        if ($images != null) {
            $newImages = [];
            foreach ($images as $image) {
                $image       = env('APP_URL') . '/storage/' . $image;
                $newImages[] = $image;
            }
            $article->third_images = $newImages;
        }
        $productIds = DB::table('sale_products')
                        ->where('sale_id', $id)
                        ->pluck('product_id')
                        ->toArray()
        ;;
        $products = Product::query()
                           ->select(
                               'id',
                               'title',
                               'price',
                               'new_price',
                               'image',
                           )
                           ->whereIn('id', $productIds)
                           ->get()
                           ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($products as $product) {
            if (json_decode($product->image) != null) {
                $product->image = env('APP_URL') . '/storage/' . json_decode($product->image)[0];
            } else {
                $product->image = env('APP_URL') . '/storage/' . $product->image;
            }
            if ($product->translations->isEmpty()) {
                $product = $product->translate('ru');
            }
        }
        $article->products = $products;

        return response()->json($article);
    }

    public function getCities()
    {
        $cities = City::with('fillials')
                      ->get()
        ;

        return response()->json([
                                    'cities' => $cities,
                                ]);
    }

    public function getBanners()
    {
        return response()->json(['banners' => Banner::all()]);
    }
}
