<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\{Category, CompleteCategory, Constructor, ConstructorCategory, Product, Subcategory};

use App\Http\Resources\{
    ConstructorResource,
    ConstructorCategoryResource
};
use Illuminate\Support\Str;
use function PHPUnit\Framework\isJson;

class ConstructorController extends Controller
{
    public function index(): JsonResponse
    {

        $categories = Category::all();


        foreach ($categories as $category) {
            $subcategories  = Subcategory::query()
                                         ->where('category_id', $category->id)
            ;
            $category->type = Str::slug($category->title);

            if ($subcategories->exists()) {
                $subcategories = $subcategories->get();
                foreach ($subcategories as $subcategory) {
                    $subcategory->image = env('APP_URL') . '/storage/' . $subcategory->image;
                    if ($subcategory->preview_image != null) {
                        $subcategory->preview_image = env('APP_URL') . '/storage/' . json_decode(
                                $subcategory->preview_image, true
                            )[0]['download_link'];
                    }
                    $check = $this->check($subcategory->id);
                    if (!$check) {
                        $subcategory->check = true;
                    }
                }
                $subcategories = $subcategories->whereNotNull('check');

                $subcategories->makeHidden(['created_at', 'updated_at', 'category_id']);
                $category->image = env('APP_URL') . '/storage/' . $category->image;

                $category->constructor = $subcategories->values();
            }
        }
//        $categories = $categories->whereNotNull('constructor');

        $categories = $categories->makeHidden(['created_at', 'updated_at', 'text'])
                                 ->toArray()
        ;

        foreach ($categories as $key => $category) {
            if (!isset($category['constructor'])) {
                unset($categories[$key]);
            }
        }

        return response()->json(
            array_values($categories)
        );
    }

    public function check($id)
    {
        $constructor = CompleteCategory::query()
                                       ->where('subcategory_id', $id)
                                       ->get()
                                       ->makeHidden(['created_at', 'updated_at'])
        ;
        foreach ($constructor as $category) {
            $category->image = env('APP_URL') . '/storage/' . $category->image;

            $category->constructorElements = Product::query()
                                                    ->select('id', 'title', 'price', 'new_price', 'image')
                                                    ->where('complete_id', $category->id)
                                                    ->where('is_constructor', true)
                                                    ->get()
            ;
            if ($category->constructorElements->isEmpty()) {
                unset($category->constructorElements);
            }
        }

        $constructor = $constructor->whereNotNull('constructorElements');

        return $constructor->isEmpty();
    }

    public function constructor($id)
    {
        $constructor = Subcategory::query()
                                  ->where('id', $id)
                                  ->first()
        ;
        $constructor->makeHidden(['created_at', 'updated_at', 'category_id']);
        $images             = [];
        $constructor->image = env('APP_URL') . '/storage/' . $constructor->image;
        if ($constructor->preview_image != null) {
            $constructor->preview_image = env('APP_URL') . '/storage/' . json_decode(
                    $constructor->preview_image, true
                )[0]['download_link'];
        }

        $constructor->categories = CompleteCategory::query()
                                                   ->where('subcategory_id', $constructor->id)
                                                   ->get()
                                                   ->makeHidden(['created_at', 'updated_at'])
        ;

        foreach ($constructor->categories as $category) {
            $category->image = env('APP_URL') . '/storage/' . $category->image;

            $category->constructorElements = Product::query()
                                                    ->select(
                                                        'id', 'title', 'price', 'new_price', 'image',
                                                        'constructor_image'
                                                    )
                                                    ->where('complete_id', $category->id)
                                                    ->where('is_constructor', true)
                                                    ->get()
            ;
            if ($category->constructorElements->isEmpty()) {
                unset($category->constructorElements);
            } else {
                foreach ($category->constructorElements as $element) {
                    if (json_decode($element->constructor_image, true)) {
                        $images = json_decode($element->constructor_image, true);
                        foreach ($images as $key => $image) {
                            $image = env('APP_URL') . '/storage/' . $image;
                            $images[$key] = $image;
                        }
                        $element->images = $images;
                    } else {
                        $element->images = null;
                    }

                    $element->image = json_decode($element->image, true)[0] ?? null;
                    if ($element->image != null) {
                        $element->image = env('APP_URL') . '/storage/' . $element->image;
                    }
                    unset($element->constructor_image);
                }
            }
        }
//        foreach ($category->constructorElements as $element) {
//            if (json_decode($element->constructor_image, true)) {
//                $element->images = json_decode($element->constructor_image, true);
//                foreach ($element->images as $item) {
//                    $item     = env('APP_URL') . '/storage/' . $item;
//                    $images[] = $item;
//                }
//                $element->image  = $images[0];
//                $element->images = $images;
//                $images          = [];
//            } elseif ($element->image == null) {
//                $element->images = null;
//            } else {
//                $element->image  = env('APP_URL') . '/storage/' . $element->image;
//                $element->images = [
//                    $element->image,
//                ];
//            }
//        }
        $constructor->categories = $constructor->categories->whereNotNull('constructorElements');

        return response()->json([
                                    'constructor' => $constructor,
                                ]);
    }

    public function category(int $id): JsonResponse
    {

        $category        = CompleteCategory::query()
                                           ->where('id', $id)
                                           ->first()
        ;
        $category->image = env('APP_URL') . '/storage/' . $category->image;

        $category->constructorElements = Product::query()
                                                ->select('id', 'title', 'price', 'new_price', 'image')
                                                ->where('complete_id', $category->id)
                                                ->where('is_constructor', true)
                                                ->get()
        ;
        foreach ($category->constructorElements as $element) {
            if (json_decode($element->image, true)) {

                $element->images = json_decode($element->image, true);
                foreach ($element->images as $item) {
                    $item     = env('APP_URL') . '/storage/' . $item;
                    $images[] = $item;
                }
                $element->image  = $images[0];
                $element->images = $images;
                $images          = [];
            } elseif ($element->image == null) {
                $element->images = null;
            } else {
                $element->image  = env('APP_URL') . '/storage/' . $element->image;
                $element->images = [
                    env('APP_URL') . '/storage/' . $element->image,
                ];
            }
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

            return env('APP_URL') . '/storage/' . $image[0]['download_link'];
        }

        return env('APP_URL') . '/storage/' . $image;
    }
}
