<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\{
    Constructor,
    ConstructorCategory,
};

use App\Http\Resources\{
    ConstructorResource,
    ConstructorCategoryResource
};
use function PHPUnit\Framework\isJson;

class ConstructorController extends Controller
{
    public function index(): JsonResponse
    {
        $constructors = Constructor::all();
        foreach ($constructors as $constructor) {
            $constructor->template_image = $this->parseImage($constructor->template_image);
            $constructor->wide_image     = $this->parseImage($constructor->wide_image);
            $constructor->square_image   = $this->parseImage($constructor->square_image);
        }
        return response()->json($constructors);
    }

    public function constructor($slug){

        $constructor = Constructor::with('categories', 'types')->where('slug', $slug)->firstOrFail();
        $constructor->square_image = $this->parseImage($constructor->square_image);
        $constructor->wide_image = $this->parseImage($constructor->wide_image);
        $constructor->template_image = $this->parseImage($constructor->template_image);
        $images = [];
        foreach($constructor->categories as $category) {
            $category->constructorElements;
            foreach($category->constructorElements as $element){
                $element->preview_image = env('APP_URL').'/storage/'.$element->preview_image;
                $element->images = json_decode($element->images, true);
                foreach ($element->images as $item){
                    $item = env('APP_URL').'/storage/'.$item;
                    $images[] = $item;
                }
                $element->images = $images;
                $images = [];
            }
        }

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

    protected function parseImage($image)
    {
        $check = json_decode($image, true);

        if ($check) {
            $image = json_decode($image, true);
            return env('APP_URL').'/storage/'.$image[0]['download_link'];
        }

        return env('APP_URL').'/storage/'.$image;
    }
}
