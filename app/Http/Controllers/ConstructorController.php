<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\{Category, CompleteCategory, Constructor, ConstructorCategory, Product, Subcategory};

use App\Http\Resources\{
    ConstructorResource,
    ConstructorCategoryResource
};
use function PHPUnit\Framework\isJson;

class ConstructorController extends Controller
{
    public function index(): JsonResponse
    {

        $categories = Category::all();

        foreach ($categories as $category) {
            $constructors = Constructor::query()
                                       ->where('category_id', $category->id)
            ;
            if ($constructors->exists()) {
                $constructors = $constructors->get();
                foreach ($constructors as $constructor) {
                    $constructor->template_image = $this->parseImage($constructor->template_image);
                    $constructor->wide_image     = $this->parseImage($constructor->wide_image);
                    $constructor->square_image   = $this->parseImage($constructor->square_image);
                }
                $category->image = env('APP_URL') . '/storage/' . $category->image;
                $category->constructors = $constructors;
            }
        }

        $categories = $categories->whereNotNull('constructors');
        return response()->json($categories->values());
    }

    public function constructor($slug)
    {

        $constructor                 = Constructor::with('categories', 'types')
                                                  ->where('slug', $slug)
                                                  ->firstOrFail()
        ;
        $constructor->square_image   = $this->parseImage($constructor->square_image);
        $constructor->wide_image     = $this->parseImage($constructor->wide_image);
        $constructor->template_image = $this->parseImage($constructor->template_image);
        $images                      = [];

        $subcategories = Subcategory::query()
                                    ->where('category_id', $constructor->category_id)
                                    ->get()
        ;


        $completeCategories = CompleteCategory::query()
                                              ->whereIn(
                                                  'subcategory_id', $subcategories->pluck('id')
                                                                                  ->toArray()
                                              )
                                              ->get()
        ;

        foreach ($constructor->categories as $category) {

            foreach ($category->constructorElements as $element) {
                $element->image  = env('APP_URL') . '/storage/' . $element->image;
                $element->images = json_decode($element->images, true);
                foreach ($element->images as $item) {
                    $item     = env('APP_URL') . '/storage/' . $item;
                    $images[] = $item;
                }

                $element->images = $images;
                $images          = [];
            }
            $additionalElements = Product::query()
                                         ->select(
                                             'id', 'title', 'price', 'new_price', 'constructor_id', 'image',
                                             'constructor_image'
                                         )
                                         ->where('constructor_id', $category->id)
                                         ->get()
            ;
            foreach ($additionalElements as $element) {
                $element->image = env('APP_URL') . '/storage/' . json_decode($element->image, true)[0];
                $images         = json_decode($element->constructor_image, true);
                for ($i = 0; $i < count($images); $i++) {
                    $images[$i] = env('APP_URL') . '/storage/' . $images[$i];
                }
                unset($element->constructor_image);
                $element->images = $images;
                $category->constructorElements->push($element);
            }
        }
        foreach ($completeCategories as $completeCategory) {
            $completeCategory->constructor_elements = Product::query()
                                                             ->select(
                                                                 'id', 'title', 'price', 'new_price', 'constructor_id',
                                                                 'image', 'constructor_image'
                                                             )
                                                             ->where('complete_id', $completeCategory->id)
                                                             ->get()
            ;

            foreach ($completeCategory->constructor_elements as $element) {
                $image = json_decode($element->image, true);
                if ($image) {
                    for ($i = 0; $i < count($image); $i++) {
                        $image[$i] = env('APP_URL') . '/storage/' . $image[$i];
                    }
                    $element->images = $image;
                    $element->image  = $image[0];
                } else {
                    $element->image = env('APP_URL') . '/storage/' . $element->image;
                }
            }
            $constructor->categories[] = $completeCategory;
        }

//        dd($constructor->category_id, $subcategories, $completeCategories);


        return response()->json([
                                    'constructor' => $constructor,
                                ]);
    }

    public function category(ConstructorCategory $category): JsonResponse
    {

        foreach ($category->constructorElements as $element) {
            $element->image = env('APP_URL') . '/storage/' . $element->image;
            unset($element->images);
        }
        $additionalElements = Product::query()
                                     ->select('id', 'title', 'price', 'new_price', 'constructor_id', 'image')
                                     ->where('constructor_id', $category->id)
                                     ->get()
        ;
        foreach ($additionalElements as $element) {
            $element->image = env('APP_URL') . '/storage/' . json_decode($element->image, true)[0];
            $category->constructorElements->push($element);
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
