<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Models\{
    Product,
    Category,
    Subcategory,
    Sale,
    Favourite,
    FilterCategory,
    FilterElement,
    Certificate
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
        return response()->json(['recomendedProducts' => $recomendedProducts]);
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
        $filterElements = [];
        foreach($subcategory->products as $product){
            $product->filterElements;
            if($product->filterElements) {
                foreach($product->filterElements as $element) {
                    array_push($filterElements, $element->id);
                }
            }
        }
        $filters = FilterElement::whereIn('id', $filterElements)->get()->groupBy(function ($item, $key) {
            $category = FilterCategory::find($item->id);
            return $category->title;
        });
        return response()->json([
            'subcategory' => $subcategory,
            'filters' => $filters,
            'sales' => SaleResource::collection($sales)
        ]);
    }

    public function subcategoryFiltered(Subcategory $subcategory, Request $request){
        $ids = $request->ids;
        $products = Product::where('subcategory_id', $subcategory->id)->get();
        $productIds = [];
        foreach($products as $product){
            $product->filterElements;
            foreach($product->filterElements as $element){
                if (in_array($element->id, $ids)) array_push($productIds, $product->id);
            }
        }
        $products = Product::whereIn('id', $productIds)->get();
        return response()->json([
            'products' => $products,
        ]);
    }

    public function product(Product $product){
        $product->filterElements;
        return response()->json([
            'product' => $product,
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

    public function certificates(){
        $certificates = Certificate::all();
        return response()->json([
            'certificates' => $certificates
        ]);
    }
}
