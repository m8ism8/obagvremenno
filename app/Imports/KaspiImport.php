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

class KaspiImport implements ToCollection
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
    public function filterCreate($title, $row, $product_id)
    {
        $filterCategories = FilterCategory::query()->where('title', $title)->first();

        if ($filterCategories == null) {
            $filterCategories = FilterCategory::query()->create([
                'title' => $title
            ]);
        }

        $element = FilterElement::query()->where([
            'category_id' => $filterCategories->id,
            'title'       => $row
        ])->first();

        if ($element == null) {
            $element = FilterElement::query()->create([
                'category_id' => $filterCategories->id,
                'title'       => $row
            ]);
        }

        ElementProduct::query()
            ->create([
                'element_id' => $element->id,
                'product_id' => $product_id
            ]);
    }

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
                if ( count($row) == 20 and $row[19] == null and $row[0] and $row[0] != "merchant_sku") {
                    try {
                        if ($row[2] != null) {
                            $characteristics = '<p>' . 'Бренд:' . $row[2] . '</p>';
                        }
                        if ($row[5] != null) {
                            $characteristics .= '<p>' . 'Модель:' . $row[5] . '</p>';
                        }
                        if ($row[6] != null) {
                            $characteristics .= '<p>' . 'Назначение:' . $row[6] . '</p>';
                        }
                        if ($row[9] != null) {
                            $characteristics .= '<p>' . 'Застежка:' . $row[9] . '</p>';
                        }
                        if ($row[7] != null) {
                            $characteristics .= '<p>' . 'Способ ношения:' . $row[7] . '</p>';
                        }
                        if ($row[8] != null) {
                            $characteristics .= '<p>' . 'Материал верха:' . $row[8] . '</p>';
                        }
                        if ($row[9] != null) {
                            $characteristics .= '<p>' . 'Застежка:' . $row[9] . '</p>';
                        }
                        if ($row[10] != null) {
                            $characteristics .= '<p>' . 'Карманы:' . $row[10] . '</p>';
                        }
                        if ($row[11] != null) {
                            $characteristics .= '<p>' . 'Плечевой ремень:' . $row[11] . '</p>';
                        }
                        if ($row[12] != null) {
                            $characteristics .= '<p>' . 'Страна производства:' . $row[12] . '</p>';
                        }
                        if ($row[13] != null) {
                            $characteristics .= '<p>' . 'Размеры:' . $row[13] . '</p>';
                        }
                        if ($row[14] != null) {
                            $characteristics .= '<p>' . 'Цвет:' . $row[14] . '</p>';
                        }
                        if ($row[15] != null) {
                            $characteristics .= '<p>' . 'Комплектация:' . $row[15] . '</p>';
                        }
                        if ($row[16] != null) {
                            $characteristics .= '<p>' . 'Дополнительная информация:' . $row[16] . '</p>';
                        }
                        if ($row[17] != null) {
                            $characteristics .= '<p>' . 'Артикул производителя:' . $row[17] . '</p>';
                        }
                        if ($row[18] != null) {
                            $characteristics .= '<p>' . 'Стиль:' . $row[18] . '</p>';
                        }
                        if ($row[19] != null) {
                            $characteristics .= '<p>' . 'Цена:' . $row[19] . '</p>';
                        }

                        $description = '<p>' . $row[14] . '</p>';


                        $subcategory = Subcategory::query()->where('title', 'Каспи')->first();

                        //TODO subcategory_id СЮДА сделать сабкатегорию
                        $product = Product::create([
                            'code' => $row[0],
                            'title' => $row[1],
                            'price' => 0,
                            'characteristics' => $characteristics,
                            'description' => $description,
                            'image' => 'products/' . $row[3] . '.jpg',
                            'video' => $row[4],

                            'subcategory_id' => $subcategory->id,
                        ]);

                        if ($row[6] != null) {
                            $this->filterCreate('Назначение', $row[6], $product->id);
                        }
                        if ($row[7] != null) {
                            $this->filterCreate('Способ ношения', $row[7], $product->id);
                        }
                        if ($row[9] != null) {
                            $this->filterCreate('Застежка', $row[9], $product->id);
                        }
                        if ($row[12] != null) {
                            $this->filterCreate('Страна производства', $row[12], $product->id);
                        }
                        if ($row[14] != null) {
                            $this->filterCreate('Цвет', $row[14], $product->id);
                        }
                        if ($row[18] != null) {
                            $this->filterCreate('Стиль', $row[18], $product->id);
                        }
                        if ($row[10] != null) {
                            $this->filterCreate('Карманы', $row[10], $product->id);
                        }
                        if ($row[11] != null) {
                            $this->filterCreate('Плечевой ремень', $row[11], $product->id);
                        }
                    } catch (\Exception $e) {
                        dd($e, $row);
                    }
                }

        }
        return [
            'message' => 'done'
        ];
    }

}
