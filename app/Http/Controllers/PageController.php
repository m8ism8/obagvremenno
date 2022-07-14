<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreationRequest;
use App\Http\Requests\SalesCreationRequest;
use App\Http\Resources\NewsResource;
use App\Http\Resources\SaleResource;
use App\Models\CompleteCategory;
use App\Models\CompleteProduct;
use App\Models\NewSales;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\City;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class PageController extends Controller
{
    public function sales()
    {
        $news_items = NewSales::query()
                              ->select(
                                  'id',
                                  'image',
                                  'text',
                                  'title',
                                  'subtitle',
                                  'badge',
                                  'created_at'
                              )
                              ->orderBy('created_at', 'desc')
                              ->where('show', 1)
                              ->get()
//                              ->translate(\request()->header('Accept-Language'))
        ;


        foreach ($news_items as $news) {
//            if ($news->translations->isEmpty()) {
//                $news = $news->translate('ru');
//            }
            //$news->slug  = Str::slug($news->title);

            $image = $news->image; //your base64 encoded data
            $ext = explode(';base64',$image);
            $ext = explode('/',$ext[0]);
            $ext = $ext[1];
            $replace = substr($image, 0, strpos($image, ',')+1);

            $image = str_replace($replace, '', $image);

            $image = str_replace(' ', '+', $image);

            $imageName = Str::random(10).'.'.$ext;
            Storage::disk('public')->put($imageName, base64_decode($image));
            $news->image = Storage::disk(config('voyager.storage.disk'))->url($imageName);
        }

        return response()->json([
            'news' => NewsResource::collection($news_items),
                                ]);
    }

    public function salesById(int $id)
    {
        $article = NewSales::query()
                           ->find($id)
//                           ->translate(\request()->header('Accept-Language'))
        ;

        if ($article == null) {
            return response()->json([
                                        'message' => 'Страница не найдена',
                                    ], 404);
        }
        //$article->image = env('APP_URL') . '/storage/' . $article->image;

        $article->save();

        return new NewsResource($article);
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
                'is_main',
                'show',
                'title',
                'image',
                'text',
                'preview_image',
                'created_at'
            )
            ->orderBy('created_at', 'desc')
            ->where('show', 1)
            ->get()
//            ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($news_items as $news) {
//            if ($news->translations->isEmpty()) {
//                $news = $news->translate('ru');
//            }

            $image = $news->image; //your base64 encoded data
            $ext = explode(';base64',$image);
            $ext = explode('/',$ext[0]);
            $ext = $ext[1];
            $replace = substr($image, 0, strpos($image, ',')+1);

            $image = str_replace($replace, '', $image);

            $image = str_replace(' ', '+', $image);

            $imageName = Str::random(10).'.'.$ext;
            Storage::disk('public')->put($imageName, base64_decode($image));
            $news->image = Storage::disk(config('voyager.storage.disk'))->url($imageName);

            if ($news->preview_image != null) {

                $image_pre = $news->preview_image;
                $ext = explode(';base64',$image_pre);
                $ext = explode('/',$ext[0]);
                $ext = $ext[1];						// This will hold the value of the extension.

                $replace = substr($image_pre, 0, strpos($image_pre, ',')+1);

                $image_pre = str_replace($replace, '', $image_pre);

                $image_pre = str_replace(' ', '+', $image_pre);

                $imageName = Str::random(10).'.'.$ext;
                Storage::disk('public')->put($imageName, base64_decode($image_pre));
                $news->preview_image = Storage::disk(config('voyager.storage.disk'))->url($imageName);
            }
        }

        return response()->json([
            'sales' => SaleResource::collection($news_items)
                                ]);
    }

    public function new(int $id)
    {
        $article = Sale::query()
                       ->find($id)
        ;
//        if (!empty($article->preview_image)) {
//            $article->preview_image = env('APP_URL') . '/storage/' . $article->preview_image;
//        }
        if ($article == null) {
            return response()->json([
                                        'message' => 'Страница не найдена',
                                    ], 404);
        }

        //$article->image = env('APP_URL') . '/storage/' . $article->image;


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
        ;
        foreach ($products as $product) {
            if (json_decode($product->image) != null) {
                $product->image = Storage::disk(config('voyager.storage.disk'))->url(json_decode($product->image)[0]);
            } else {
                $product->image = Storage::disk(config('voyager.storage.disk'))->url($product->image);
            }
            $product->save();
        }
        $article->products()->sync($products);
        $article->save();

        return new SaleResource($article);
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

    public function getCompleteProducts()
    {
        $data             = [];
        $completeProducts = CompleteProduct::all();
        foreach ($completeProducts as $completeProduct) {
            $category = CompleteCategory::query()
                                        ->find($completeProduct->complete_id)
            ;

            $productIds = CompleteProduct::query()
                                         ->where('complete_id', $completeProduct->complete_id)
                                         ->pluck('product_id')
            ;

            $category->products = Product::query()
                                         ->whereIn('id', $productIds)
                                         ->get()
            ;
            $data[]             = $category;
        }

        return $data;
    }

    public function salesCreate(SalesCreationRequest $request) {
        $data = $request->validated();
        $product_ids = Product::all()->whereIn('id', array_column($data['products'], 'id'))->pluck('id');

        foreach ($data['sales'] as $sale) {
            if (Sale::where('text', ))
            $created_sale = Sale::create([
                'title' => $sale['title'],
                'show' => $sale['show'],
                'is_main' => $sale['is_main'],
                'preview_image' => $sale['preview_image'],
                'text' => $sale['text'],
                'image' => $sale['image'],
            ]);
            $created_sale->products()->sync($product_ids);
        }

        return response()->json(['message' => 'Акции созданы!']);
    }

    public function newsCreate(NewsCreationRequest $request) {
        $data = $request->validated();

        foreach ($data['news'] as $new) {
            NewSales::create([
                'title' => $new['title'],
                'show' => $new['show'],
                'subtitle' => $new['subtitle'],
                'text' => $new['text'],
                'image' => $new['image'],
            ]);
        }

        return response()->json(['message' => 'Новости созданы!']);
    }

    public function salesDelete($id) {
        $sale = Sale::find($id);
        $sale->delete();
        return response()->json(['message' => 'Акция удалена!']);
    }

    public function newsDelete($id) {
        $news = NewSales::find($id);
        $news->delete();
        return response()->json(['message' => 'Новость удалена!']);
    }

    public function salesChange(SalesCreationRequest $request, $id) {
        $data = $request->validated();
        $sale = Sale::find($id);
        $sale->update($data);
        return response()->json(['message' => 'Акция изменена!']);
    }

    public function newsChange(NewsCreationRequest $request, $id) {
        $data = $request->validated();
        $news = NewSales::find($id);
        $news->update($data);
        return response()->json(['message' => 'Новость изменена!']);
    }
}
