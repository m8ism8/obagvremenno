<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Product,
    Category,
    Subcategory,
    Sale,
    Favourite
};

use App\Http\Resources\{
    ProductResource,
    SaleResource,
    RecomendedResource,
    CategoryResource,
    SubcategoryResource,
};

class ProductController extends Controller
{
    public function getRecomended(){
        $randomCategories = Category::inRandomOrder()->take(2)->with('products')->get();
        $randomProductsIds1 = $randomCategories[0]->products->pluck('id')->random(4);
        $randomProducts1 = Product::whereIn('id', $randomProductsIds1)->get();
        $randomProductsIds2 = $randomCategories[1]->products->pluck('id')->random(4);
        $randomProducts2 = Product::whereIn('id', $randomProductsIds2)->get();
        $newestProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
        $popularProducts = Product::inRandomOrder()->take(4)->get();
        $recomendedProducts = collect([
            [
                'title' => $randomCategories[0]->title,
                'products' => $this->addImageLink($randomProducts1)
            ], 
            [
                'title' => $randomCategories[1]->title,
                'products' => $this->addImageLink($randomProducts2)
            ], 
            [
                'title' => 'Новинки',
                'products' => $this->addImageLink($newestProducts)
            ], 
            [
                'title' => 'Популярное',
                'products' => $this->addImageLink($popularProducts)
            ]
        ]);
        return $recomendedProducts;
    }

    public function addImageLink($collection){
        foreach($collection as $item){
            if($item->image && str_split($item->image, 4)[0] != 'http' ) {
                $image = env('APP_URL').'/storage/'.$this->image;
            }
        }
        return $collection;
    }

    public function index(){
        $banner = [
            'image' => env('APP_URL').'/storage/'.setting('main-banner.image'),
            'link' => setting('main-banner.link')
        ];
        $mainSale = Sale::orderBy('created_at', 'desc')->take(1)->with('products')->first();
        $sales = Sale::where('is_main', 1)->take(2)->get();
        $news = Sale::orderBy('created_at', 'desc')->take(4)->get();
        return response()->json([
            'banner' => $banner,
            'mainSale' => new SaleResource($mainSale),
            'sales' => SaleResource::collection($sales),
            'recomendedProducts' => $this->getRecomended(),
        ]);
    }
    
    public function category(Category $category){
        $sales = Sale::all();
        return response()->json([
            'category' => new CategoryResource($category), 
            'sales' => SaleResource::collection($sales),
        ]);
    }

    public function subcategory(Subcategory $subcategory){
        $sales = Sale::all();
        $subcategory->products;
        return response()->json([
            'subcategory' => $subcategory, 
            'sales' => SaleResource::collection($sales)
        ]);
    }

    public function favourite($id){
        $favourite = Favourite::where('user_id', Auth()->id())->where('product_id', $id)->firstOrCreate([
            'user_id' => Auth()->id(),
            'product_id' => $id
        ]);
        return response()->json([
            'favourite' => $favourite,
        ]);
    }

    public function search($string){
        $products = Product::where('title', 'LIKE', '%'.$string.'%')->get();
        return response()->json([
            'products' => ProductResource::collection($products),
        ]);
    }
}
