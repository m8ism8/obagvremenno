<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\{Category,
    CompleteCategory,
    CompleteProduct,
    ElementProduct,
    FilterCategory,
    FilterElement,
    Subcategory,
    Product
};

class ProductsImport implements ToCollection
{
    //0 => "Артикул"
    //1 => "Название товара"
    //2 => "Бренд"
    //3 => "Код изображений"
    //4 => "Ссылка на Youtube"
    //5 => "Модель"
    //6 => "Тип"
    //7 => "Назначение"
    //8 => "Материал"
    //9 => "цвет"
    //10 => "Застежка"
    //11 => "Отделение для монет"
    //12 => "Отделения для карт/визиток"
    //13 => "Страна производства"
    //14 => "Размеры"
    //15 => "Дополнительная информация"
    //16 => "Артикул производителя"
    //17 => "Описание"
    //18 => "Цена"
    //19 => "Категория"
    //20 => "Подкатегория"
    //21 => "Категория комплектующие"
    //22 => "Остатки"
    //23 => "Категория конструктора "
    //24 => "Конструктор картинка"

//0 => "Артикул"
//1 => "Название товара"
//2 => "Бренд"
//3 => "Код изображений"
//4 => "Модель"
//5 => "Ссылка на Youtube"
//6 => "Тип"
//7 => "Назначение"
//8 => "Материал"
//9 => "Цвет"
//10 => "Застежка"
//11 => "Отделение для монет"
//12 => "Отделения для карт/визиток"
//13 => "Страна производства"
//14 => "Размеры"
//15 => "Дополнительная информация"
//16 => "Артикул производителя"
//17 => "Цена"
//18 => "Подкатегория продукта"
//19 => "Категории комплектующие"
//20 => "Комплектующие"
//21 => "Остатки"
//22 => "Описание"
//23 => "Конструктор"
//24 => "Конструктор картинка"
//25 => "Конструктор картинка 2"
    public function filterCreate($title, $row, $product_id)
    {
        $filterCategories = FilterCategory::query()
                                          ->where('title', $title)
                                          ->first()
        ;

        if ($filterCategories == null) {
            $filterCategories = FilterCategory::query()
                                              ->create([
                                                           'title' => $title,
                                                       ])
            ;
        }

        $element = FilterElement::query()
                                ->where([
                                            'category_id' => $filterCategories->id,
                                            'title'       => $row,
                                        ])
                                ->first()
        ;

        if ($element == null) {
            if ($row != null) {
                $element = FilterElement::query()
                                        ->create([
                                                     'category_id' => $filterCategories->id,
                                                     'title'       => $row,
                                                 ])
                ;
            }
        }
        if ($row != null) {
            ElementProduct::query()
                          ->create([
                                       'element_id' => $element->id,
                                       'product_id' => $product_id,
                                   ])
            ;
        }
    }

    public function collection(Collection $rows): array
    {

        foreach ($rows as $row) {
            if ($row[0] == 'Артикул' or $row[0] == null) {

            } else {
                $check = Product::query()
                                ->where('code', $row[0])
                                ->exists()
                ;
                if (!$check) {
                    try {

                        DB::beginTransaction();
                        if ($row[18] != null) {
                            $subcategory = Subcategory::query()
                                                      ->where('title', $row[18])
                            ;
                            if ($subcategory->exists()) {
                                $subcategory = $subcategory->first()->id;
                            } else {
                                dd('ТАКОЙ ПОДКАТЕГОРИИ НЕТ');
                            }
                        }
                        if ($row[19] != null) {
                            $complete = CompleteCategory::query()
                                                        ->where('title', $row[19])
                            ;
                            if ($complete->exists()) {
                                $complete = $complete->first()->id;
                            } else {
                                $complete = CompleteCategory::query()
                                                            ->create([
                                                                         'title'          => $row[19],
                                                                         'image'          => 'NULL',
                                                                         'subcategory_id' => $subcategory,
                                                                     ])->id;
                            }
                        } else {
                            $complete = null;
                        }

                        if ($row[3] != null) {
                            $images = Storage::disk('public')
                                             ->allFiles('products/' . $row[3] . '/')
                            ;
                            if (!empty($images)) {
                                foreach ($images as $key => $image) {
                                    $check = strpos($image, '150x150');
                                    if ($check) {
                                        unset($images[$key]);
                                    }
                                }
                            }
                            $images = json_encode(array_values($images));
                        }

                        $characteristics = '<p>' . 'Артикул: ' . $row[0] . '</p>';
                        if ($row[2] != null) {
                            $characteristics .= '<p>' . 'Бренд: ' . $row[2] . '</p>';
                        }
                        if ($row[5] != null) {
                            $characteristics .= '<p>' . 'Модель: ' . $row[4] . '</p>';
                        }

                        if ($row[6] != null) {
                            $characteristics .= '<p>' . 'Тип: ' . $row[6] . '</p>';
                        }
                        if ($row[7] != null) {
                            $characteristics .= '<p>' . 'Назначение: ' . $row[7] . '</p>';
                        }
                        if ($row[8] != null) {
                            $characteristics .= '<p>' . 'Материал: ' . $row[8] . '</p>';
                        }
                        if ($row[9] != null) {
                            $characteristics .= '<p>' . 'Цвет: ' . $row[9] . '</p>';
                        }
                        if ($row[10] != null) {
                            $characteristics .= '<p>' . 'Застежка: ' . $row[10] . '</p>';
                        }
                        if ($row[11] != null) {
                            $characteristics .= '<p>' . 'Отделение для монет: ' . $row[11] . '</p>';
                        }
                        if ($row[12] != null) {
                            $characteristics .= '<p>' . 'Отделения для карт/визиток: ' . $row[12] . '</p>';
                        }
                        if ($row[13] != null) {
                            $characteristics .= '<p>' . 'Страна производства: ' . $row[13] . '</p>';
                        }
                        if ($row[14] != null) {
                            $characteristics .= '<p>' . 'Размеры: ' . $row[14] . '</p>';
                        }
                        if ($row[15] != null) {
                            $characteristics .= '<p>' . 'Дополнительная информация: ' . $row[15] . '</p>';
                        }
                        if ($row[16] != null) {
                            $characteristics .= '<p>' . 'Артикул производителя: ' . $row[16] . '</p>';
                        }
                        if ($row[17] != null) {
                            $description = '<p>' . $row[22] . '</p>';
                        }

                        if ($row[23] == 'Да') {
                            $isConstructor = true;
                        } else {
                            $isConstructor = false;
                        }

                        $product = Product::query()
                                          ->create([
                                                       'code'            => $row[0],
                                                       'title'           => $row[1],
                                                       'price'           => $row[17],
                                                       'characteristics' => $characteristics,
                                                       'description'     => $description ?? null,
                                                       'image'           => $images,
                                                       'video'           => $row[5],
                                                       'remainder'       => $row[21] ?? null,
                                                       'subcategory_id'  => $subcategory->id ?? null,
                                                       'complete_id'     => $complete,
                                                       'is_constructor'  => $isConstructor,
                                                   ])
                        ;
                        //                    dd($rows);
                        //                    if ($row[21] != null) {
                        //                        $data = explode(',', $row[21]);
                        //                        foreach ($data as $item) {
                        //                            $item            = trim($item);
                        //                            $completeProduct = Product::query()
                        //                                                      ->where('title', $item)
                        //                                                      ->first()
                        //                            ;
                        //                            CompleteProduct::query()
                        //                                           ->create([
                        //                                                        'complete_id' => $completeProduct->id,
                        //                                                        'product_id'  => $product->id,
                        //                                                    ])
                        //                            ;
                        //                        }
                        //
                        //                    }


                        if ($row[7] != null) {
                            $this->filterCreate('Назначение', $row[7], $product->id);
                        }
                        if ($row[8] != null) {
                            $this->filterCreate('Материал', $row[8], $product->id);
                        }

                        if ($row[9] != null) {
                            $this->filterCreate('Цвет', $row[9], $product->id);
                        }

                        if ($row[10] != null) {
                            $this->filterCreate('Застежка', $row[10], $product->id);
                        }

                        if ($row[11] != null) {
                            $this->filterCreate('Отделение для монет', $row[11], $product->id);
                        }

                        if ($row[12] != null) {
                            $this->filterCreate('Отделения для карт/визиток', $row[12], $product->id);
                        }

                        if ($row[13] != null) {
                            $this->filterCreate('Страна производства', $row[13], $product->id);
                        }

                        if ($row[14] != null) {
                            $this->filterCreate('Размеры', $row[14], $product->id);
                        }
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        dd($e);
                    }
                } else {
                    $product = Product::query()
                                      ->where('code', $row[0])
                                      ->update([
                                                   'remainder'       => $row[21] ?? null
                                               ])
                    ;
                }
            }
        }

        return [
            'message' => 'done',
        ];
    }

}
