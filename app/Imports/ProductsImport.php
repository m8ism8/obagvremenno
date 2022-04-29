<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\{Category,
    CompleteCategory,
    CompleteProduct,
    ElementProduct,
    FilterCategory,
    FilterElement,
    Subcategory,
    Product};

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
    //17 => "Подкатегория продукта"
    //18 => "Категории комплектующие"
    //19 => "Комплектующие"

    public function collection(Collection $rows): array
    {
        foreach($rows as $row) {
            if($row[0]=='Артикул') {

            }
            else {
                dd($rows);

                try {
                    if ($row[18] != null) {
                        $complete = CompleteCategory::query()->where('title', $row[18])->first()->id;
                    } else {
                        $complete = null;
                    }
                    dd($row);
                    $characteristics  = '<p>' . 'Бренд:'    . $row[2].'</p>';
                    $characteristics .= '<p>' . 'Тип:'      . $row[5].'</p>';
                    $characteristics .= '<p>' . 'Материал:' . $row[7].'</p>';
                    $characteristics .= '<p>' . 'Застежка:' . $row[9].'</p>';
                    $characteristics .= '<p>' . 'Отделение для монет:' . $row[10].'</p>';
                    $characteristics .= '<p>' . 'Отделения для карт/визиток:' . $row[11].'</p>';
                    $characteristics .= '<p>' . 'Страна производства:'        . $row[12].'</p>';
                    $characteristics .= '<p>' . 'Размеры:' . $row[13].'</p>';
                    $characteristics .= '<p>' . 'Дополнительная информация:' . $row[14].'</p>';

                    $description = '<p>'.$row[21].'</p>';

                    $subcategory = Subcategory::query()->where('title', $row[17])->first();

                    $product = Product::query()->create([
                        'code'  => $row[0],
                        'title' => $row[1],
                        'price' => $row[16],
                        'characteristics' => $characteristics,
                        'description' => $description,
                        'image' => 'products/' . $row[3] . '.jpg',
                        'video' => $row[4],
                        'remainder' => $row[20],
                        'subcategory_id' => $subcategory->id,
                        'complete_id'    => $complete
                    ]);

                    if ($row[19] != null) {
                        $data = explode(',', $row[19]);
                        foreach ($data as $item) {
                            $item = trim($item);
                            $completeProduct = Product::query()->where('title', $item)->first();
                            CompleteProduct::query()->create([
                                'complete_id' => $completeProduct->id,
                                'product_id'  => $product->id
                            ]);
                        }

                    }

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
