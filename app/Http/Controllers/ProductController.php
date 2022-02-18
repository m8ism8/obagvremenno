<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Product,
    Category,
    Subcategory,
    Sale
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
        $sales = Sale::all();
        return response()->json([
            'sales' => $sales,
            'category' => $category, 
            'subcategories' => $category->subcategories
        ]);
    }
    public function subcategory(Subcategory $subcategory){
        $sales = Sale::all();
        return response()->json([
            'sales' => $sales,
            'subcategory' => $subcategory, 
            'products' => $subcategory->products
        ]);
    }
}
