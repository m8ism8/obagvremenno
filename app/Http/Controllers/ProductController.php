<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;
use App\Models\{CompleteCategory,
    CompleteProduct,
    Product,
    Category,
    Subcategory,
    Sale,
    Favourite,
    FilterCategory,
    FilterElement,
    Certificate};

use App\Http\Resources\{
    ProductResource,
    SaleResource,
    RecomendedResource,
    CategoryResource,
    CategoriesResource,
    SubcategoryResource,
    CertificateResource,
};

class ProductController extends Controller
{
    public function getRecomended(){

        try {
            $randomCategories = Category::inRandomOrder()->take(2)->with('products')->get();
            $randomProductsIds1 = $randomCategories[0]->products->pluck('id')->random(4);
            $randomProducts1 = Product::whereIn('id', $randomProductsIds1)->get();
            $randomProductsIds2 = $randomCategories[1]->products->pluck('id')->random(4);
            $randomProducts2 = Product::whereIn('id', $randomProductsIds2)->get();
            $newestProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
            $popularProducts = Product::inRandomOrder()->take(4)->get();
        } catch (\Exception $exception) {
            return [];
        }



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
            $item->isFavorite = Favourite::query()
                ->where('product_id',$item->id)
                ->where('user_id', Auth::guard('sanctum')->id())
                ->exists();
            if($item->image && str_split($item->image, 4)[0] != 'http' ) {
                $image = env('APP_URL').'/storage/'.$item->image;
            }
        }
        return $collection;
    }

    public function getFilters($products){
        $filterElementsIds = [];
        foreach($products as $product){
            $product->filterElements;
            if($product->filterElements) {
                foreach($product->filterElements as $element) {
                    if(!in_array($element->id, $filterElementsIds)) $filterElementsIds[]=$element->id;
                }
            }
        }
        $filters = FilterElement::whereIn('id', $filterElementsIds)->get();
        $filterFinal = [];
        $filterCategoriesUsed = [];
        foreach($filters as $filter) {
            $category = FilterCategory::find($filter->category_id);
            if(!in_array($filter->category_id, $filterCategoriesUsed)){
                $filterCategoriesUsed[]=$filter->category_id;
                $filterFinal[$category->title] = [$filter];
            }
            else {
                array_push($filterFinal[$category->title], $filter);
            }
        }
        return $filterFinal;
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

    public function getcategories(){
        $categories = category::with('subcategories')->get();
        return response()->json([
            'categories' => CategoriesResource::collection($categories)
        ]);
    }

    public function category(Category $category){
        $sales = Sale::all();

        $filters = $this->getFilters($category->products);

        return response()->json([
            'filters' => $filters,
            'category' => new CategoryResource($category),
            'sales' => SaleResource::collection($sales),
        ]);
    }

    public function categoryFiltered(category $category, Request $request){
        $products = $category->products;
        foreach($products as $product) {
            $product->actualPrice = $product->new_price ?? $product->price;
        }
        if($request->price_from) $products = $products->where('actualPrice', '>=', $request->price_from);
        if($request->price_to) $products = $products->where('actualPrice', '<=', $request->price_to);

        if($request->ids) {
            $ids = $request->ids;
            $productIds = [];
            foreach($products as $product){
                $product->filterElements;
                foreach($product->filterElements as $element){
                    if (in_array($element->id, $ids) && !in_array($product->id, $productIds)) array_push($productIds, $product->id);
                }
            }
        }
        else {
            $productIds = $products->pluck('id');
        }
        $products = Product::whereIn('id', $productIds)->get();


        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                ->where('product_id',$product->id)
                ->where('user_id', Auth::guard('sanctum')->id())
                ->exists();
        }

        if ($request->sort_price) {
            $products = $products->sortBy([
                [
                    'price', $request->sort_price
                ]
            ]);
        }


        return response()->json([
            'products' => $products,
        ]);
    }

    public function subcategory(Subcategory $subcategory){

        if (request()->has('sort_price')) {
            $subcategory->product = $subcategory->products->sortBy([
                [
                    'price', request()->input('sort_price')
                ]
            ]);
        }
        $sales = Sale::all();
        $filters = $this->getFilters($subcategory->products);

        foreach ($subcategory->products as $product) {
            $product->isFavorite = Favourite::query()
                ->where('product_id',$product->id)
                ->where('user_id', Auth::guard('sanctum')->id())
                ->exists();
        }

        $completes = CompleteCategory::query()
            ->where('subcategory_id', $subcategory->id)
            ->get();

        foreach ($completes as $complete) {
            $complete->image = env('APP_URL').'/storage/'.$complete->image;
        }

        return response()->json([
            'subcategory' => $subcategory,
            'completes'  => $completes,
            'filters' => $filters,
            'sales' => SaleResource::collection($sales)
        ]);
    }

    public function subcategoryFiltered(Subcategory $subcategory, Request $request)
    {

        if (isset($request->complete_id)) {
            $products = Product::query()->where('complete_id', $request->complete_id)->get();
        }else {
            $products = Product::where('subcategory_id', $subcategory->id)->get();
        }
        foreach($products as $product) {
            $product->actualPrice = $product->new_price ?? $product->price;
        }
        if($request->price_from) $products = $products->where('actualPrice', '>=', $request->price_from);
        if($request->price_to) $products = $products->where('actualPrice', '<=', $request->price_to);

        if($request->ids) {
            $ids = $request->ids;
            $productIds = [];
            foreach($products as $product){
                $product->filterElements;
                foreach($product->filterElements as $element){
                    if (in_array($element->id, $ids) && !in_array($product->id, $productIds)) array_push($productIds, $product->id);
                }
            }
        }
        else {
            $productIds = $products->pluck('id');
        }
        $products = Product::whereIn('id', $productIds)->get();

        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                ->where('product_id',$product->id)
                ->where('user_id', Auth::guard('sanctum')->id())
                ->exists();
        }

        if ($request->sort_price) {
            $products = $products->sortBy([
                [
                    'price', $request->sort_price
                ]
            ]);
        }

        return response()->json([
            'products' => $products,
        ]);
    }

    public function product(Product $product){
        $product->filterElements;
        $product->reviews;

        $complete =  CompleteProduct::query()
            ->where('product_id', $product->id)
            ->join('products', 'products.id','=','complete_products.complete_id')
            ->select('products.*')
            ->get();

        foreach ($complete as $item) {
            $item->image = env('APP_URL').'/storage/'.$item->image;
        }

        $product->complete   = $complete;

        $product->isFavorite = Favourite::query()
            ->where('product_id',$product->id)
            ->where('user_id', Auth::guard('sanctum')->id())
            ->exists();



        return response()->json([
            'product' => new ProductResource($product),
        ]);
    }

    public function favouriteDelete($id)
    {

        $favorite = Favourite::query()
                                ->where('user_id', Auth::id())
                                ->where('product_id', $id)
                                ->first();
        if (!isset($favorite)) {
            return response()->json(
                [
                    'message' => 'Товара нет в корзине',
                ], 422
            );
        }

        $favorite->delete();

        return response()->json([
                'message' => 'Товар успешно удален'
        ],200);
    }

    public function search($string){
        $products = Product::where('title', 'LIKE', '%'.$string.'%')->get();

        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                ->where('product_id',$product->id)
                ->where('user_id', Auth::guard('sanctum')->id())
                ->exists();
        }

        return response()->json([
            'products' => ProductResource::collection($products),
        ]);
    }

    public function certificates(){
        $certificates = Certificate::all();
        return response()->json([
            'certificates' => CertificateResource::collection($certificates)
        ]);
    }
}
