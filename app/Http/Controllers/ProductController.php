<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Product,
    Category,
    Subcategory
};

class ProductController extends Controller
{
    public function subcategory(Subcategory $subcategory){
        return response()->json([
            'subcategory' => $subcategory, 
            'products' => $subcategory->products
        ]);
    }
    public function category(Category $category){
        return response()->json([
            'category' => $category, 
            'subcategories' => $category->subcategories
        ]);
    }
}
