<?php

namespace App\Imports;

use App\Models\CompleteCategory;
use App\Models\ElementProduct;
use App\Models\FilterCategory;
use App\Models\FilterElement;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class BackpacksImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row[0]=='Артикул') {

            }
            else {
                try {
//                    if ($row[10] != null) {
//                        $category = Category::where('title', $row[10])->firstOrCreate([
//                            'title' => $row[10],
//                            'full_title' => $row[10]
//                        ]);
//                    }
//                    if ($row[11] != null) {
//                        $subcategory = Subcategory::where('title', $row[11])->where('category_id', $category->id)->firstOrCreate([
//                            'title' => $row[11],
//                            'category_id' => $category->id
//                        ]);
//                    }

                    $complete = CompleteCategory::query()->where('title', $row[12])->first();

                    $characteristics  = '<p>' . 'Бренд:'    . $row[2].'</p>';
                    $characteristics .= '<p>' . 'Материал верха:'      . $row[8].'</p>';
                    $characteristics .= '<p>' . 'Страна производства:' . $row[12].'</p>';
                    $characteristics .= '<p>' . 'Размеры:' . $row[13].'</p>';
                    $characteristics .= '<p>' . 'Цвет:' . $row[14].'</p>';
                    $characteristics .= '<p>' . 'Артикул производителя:' . $row[17].'</p>';
                    $characteristics .= '<p>' . 'Стиль:' . $row[18].'</p>';

                    $description = '<p>'.$row[11].'</p>';
                    $subcategory = Subcategory::query()->where('title', 'Рюкзаки')->first();



                    //TODO subcategory_id СЮДА сделать сабкатегорию
                    $product = Product::create([
                        'code'  => $row[0],
                        'title' => $row[1],
                        'price' => $row[19],
                        'characteristics' => $characteristics,
                        'description' => $description,
                        'image' => 'products/' . $row[3],
                        'video' => $row[4],

                        'subcategory_id' => $subcategory->id,

//                        'complete_id' => 'ЕСЛИ КОМЛЕКТ'
//                        'price' => $row[2],
//                        'new_price' => $row[3] ?? null,
//                        'badge' => $row[4] ?? null,
//                        'available' => $row[5],
//                        'characteristics' => $characteristics,
//                        'description' => $description,
//                        'image' => $row[8] ?? null,
//                        'video' => $row[9] ?? null,
//                        'subcategory_id' => $subcategory->id ?? null,
//                        'complete_id'    => $complete->id ?? null
                    ]);


                    //Назначение $row[6]
                    $filterCategories = FilterCategory::query()->where('title', 'Назначение')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Назначение'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[6]
                    ])->first();

                    if ($element == null) {
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[6]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
                    //КОНЕЦ Назначение $row[6]


                    //Способ ношения $row[7]
                    $filterCategories = FilterCategory::query()->where('title', 'Способ ношения')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Способ ношения'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[7]
                    ])->first();

                    if ($element == null) {
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[7]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
                    //КОНЕЦ Способ ношения $row[7]


                    //Карманы $row[10]
                    $filterCategories = FilterCategory::query()->where('title', 'Карманы')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Карманы'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[10]
                    ])->first();

                    if ($element == null) {
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[10]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
                    //Карманы $row[10]


                    //Плечевой ремень $row[11]
                    $filterCategories = FilterCategory::query()->where('title', 'Плечевой ремень')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Плечевой ремень'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[11]
                    ])->first();

                    if ($element == null) {
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[11]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
                    //Плечевой ремень $row[11]


                    //Размеры $row[13]
                    $filterCategories = FilterCategory::query()->where('title', 'Размеры')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Размеры'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[13]
                    ])->first();

                    if ($element == null) {
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[13]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
                    //Размеры $row[13]



                    //НАЧАЛО ЦВЕТ $row[14]

                    $filterCategories = FilterCategory::query()->where('title', 'Цвет')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Цвет'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[14]
                    ])->first();

                    if ($element == null){
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[14]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);

                    //КОНЕЦ ЦВЕТ


                    //НАЧАЛО Стиль $row[18]

                    $filterCategories = FilterCategory::query()->where('title', 'Стиль')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Стиль'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[18]
                    ])->first();

                    if ($element == null){
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[18]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);

                    //КОНЕЦ Стиль

                }
                catch (\Exception $e) {
                    dd($e);
                }
            }
        }
        return [
            'message' => 'done'
        ];
    }

}
