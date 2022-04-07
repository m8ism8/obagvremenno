<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\{Category, CompleteCategory, ElementProduct, FilterCategory, FilterElement, Subcategory, Product};

class ProductsImport implements ToCollection
{
    //0 => "Артикул"
    //1 => "Название товара"
    //2 => "Бренд"
    //3 => "Код изображений"
    //4 => "Ссылка на Youtube"
    //5 => "Тип"
    //6 => "Назначение"
    //7 => "Материал"
    //8 => "Цвет"
    //9 => "Застежка"
    //10 => "Отделение для монет"
    //11 => "Отделения для карт/визиток"
    //12 => "Страна производства"
    //13 => "Размеры"
    //14 => "Дополнительная информация"
    //15 => "Артикул производителя"
    //16 => "Цена"

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
                    $characteristics .= '<p>' . 'Тип:'      . $row[5].'</p>';
                    $characteristics .= '<p>' . 'Материал:' . $row[7].'</p>';
                    $characteristics .= '<p>' . 'Застежка:' . $row[9].'</p>';
                    $characteristics .= '<p>' . 'Отделение для монет:' . $row[10].'</p>';
                    $characteristics .= '<p>' . 'Отделения для карт/визиток:' . $row[11].'</p>';
                    $characteristics .= '<p>' . 'Страна производства:' . $row[12].'</p>';
                    $characteristics .= '<p>' . 'Размеры:' . $row[13].'</p>';

                    $description = '<p>'.$row[14].'</p>';


                    $subcategory = Subcategory::query()->where('title', 'Кошельки')->first();
                    //TODO subcategory_id СЮДА сделать сабкатегорию
                    $product = Product::create([
                        'code'  => $row[0],
                        'title' => $row[1],
                        'price' => $row[16],
                        'characteristics' => $characteristics,
                        'description' => $description,
                        'image' => 'products/' . $row[3] . '.jpg',
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

                    //НАЧАЛО ЦВЕТ $row[8]

                    $filterCategories = FilterCategory::query()->where('title', 'Цвет')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Цвет'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[8]
                    ])->first();

                    if ($element == null){
                        $element = FilterElement::query()->create([
                            'category_id' => $filterCategories->id,
                            'title'       => $row[8]
                        ]);
                    }

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);

                    //КОНЕЦ ЦВЕТ

                    //НАЧАЛО РАЗМЕРЫ $row[13]

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

                    if ($element == null){
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

                    //КОНЕЦ РАЗМЕРЫ


                    //НАЧАЛО Дополнительная информация $row[14]

                    $filterCategories = FilterCategory::query()->where('title', 'Дополнительная информация')->first();

                    if ($filterCategories == null) {
                        $filterCategories = FilterCategory::query()->create([
                            'title' => 'Дополнительная информация'
                        ]);
                    }

                    $element = FilterElement::query()->where([
                        'category_id' => $filterCategories->id,
                        'title'       => $row[14]
                    ])->first();

                    if ($element == null) {
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

                    //КОНЕЦ Дополнительная информация
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
