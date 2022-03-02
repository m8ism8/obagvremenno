<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Constructor,
    ConstructorCategory,
};

class ConstructorController extends Controller
{
    public function constructor($slug){
        $constructor = constructor::with('categories', 'types')->where('slug', $slug)->firstOrFail();
        return response()->json([
            'constructor' => $constructor,
        ]);
    }

    public function category(ConstructorCategory $category){
        $category->constructorElements;
        return response()->json([
            'category' => $category,
        ]);
    }
}
