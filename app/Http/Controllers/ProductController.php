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
        $recomendedProducts = collect([$randomProducts1, $randomProducts2, $newestProducts, $popularProducts]);
        return $recomendedProducts;
    }

    public function index(){
        $mainSale = Sale::orderBy('created_at', 'desc')->take(1)->with('products')->get();
        $sales = Sale::where('is_main', 1)->take(2)->get();
        $news = Sale::orderBy('created_at', 'desc')->take(4)->get();
        return response()->json([
            'mainSale' => $mainSale,
            'sales' => $sales,
            'recomendedProducts' => $this->getRecomended(),
        ]);
    }
    
    public function category(Category $category){
        $category->subcategories;
        $category->constructor;
        $sales = Sale::all();
        return response()->json([
            'category' => $category, 
            'sales' => $sales,
        ]);
    }

    public function subcategory(Subcategory $subcategory){
        $sales = Sale::all();
        $subcategory->products;
        return response()->json([
            'sales' => $sales,
            'subcategory' => $subcategory, 
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
}
