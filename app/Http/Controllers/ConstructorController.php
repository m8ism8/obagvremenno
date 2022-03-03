<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\{
    Constructor,
    ConstructorCategory,
};

use App\Http\Resources\{
    ConstructorResource,
    ConstructorCategoryResource
};

class ConstructorController extends Controller
{
    public function constructor($slug){
        $constructor = constructor::where('slug', $slug)->firstOrFail();
        return response()->json([
            'constructor' => new ConstructorResource($constructor),
        ]);
    }

    public function category(ConstructorCategory $category){
        $category->constructorElements;
        return response()->json([
            'category' => ConstructorCategoryResource::collection($category),
        ]);
    }
}
