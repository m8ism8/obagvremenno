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
        $constructor = constructor::with('categories', 'types')->where('slug', 'watch')->firstOrFail();
        $constructor->square_image = env('APP_URL').'/storage/'.$constructor->square_image;
        $constructor->wide_image = env('APP_URL').'/storage/'.$constructor->wide_image;
        $constructor->template_image = env('APP_URL').'/storage/'.$constructor->template_image;
        return response()->json([
            'constructor' => $constructor,
        ]);
    }

    public function category(ConstructorCategory $category){
        $category->constructorElements;
        foreach($category->constructorElements as $element){
            $element->image = env('APP_URL').'/storage/'.$element->image;
        }
        return response()->json([
            'category' => $category,
        ]);
    }
}
