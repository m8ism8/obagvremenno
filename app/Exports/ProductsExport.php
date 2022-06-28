<?php

namespace App\Exports;

use App\Models\CompleteCategory;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromArray
{
    public function array(): array
    {
        $products = Product::all();
        $data     = [];
        $data[]   = [
            '0'  => 'Артикул',
            '1'  => 'Название товара',
            '2'  => 'Бренд',
            '3'  => 'Код изображений',
            '4'  => 'Модель',
            '5'  => 'Ссылка на Youtube',
            '6'  => 'Тип',
            '7'  => 'Назначение',
            '8'  => 'Материал',
            '9'  => 'Цвет',
            '10' => 'Застежка',
            '11' => 'Отделение для монет',
            '12' => 'Отделения для карт/визиток',
            '13' => 'Страна производства',
            '14' => 'Размеры',
            '15' => 'Дополнительная информация',
            '16' => 'Артикул производителя',
            '17' => 'Цена',
            '18' => 'Подкатегория продукта',
            '19' => 'Категории комплектующие',
            '20' => 'Комплектующие',
            '21' => 'Остатки',
            '22' => 'Описание',
            '23' => 'Конструктор',
            '24' => 'Конструктор картинка',
            '25' => "Конструктор картинка 2",
            '26' => 'seo_title',
            '27' => 'seo_description',
            '28' => 'seo_content',
        ];
        foreach ($products as $product) {
            $arr        = [];
            $brand      = '';
            $model      = '';
            $type       = '';
            $purpose    = '';
            $material   = '';
            $color      = '';
            $coin       = '';
            $depart     = '';
            $depart2    = '';
            $country    = '';
            $dimensions = '';
            $additional = '';
            $articulMan = '';

            preg_match_all('|<p>(.*)</p>|Uis', $product->characteristics, $arr);

            foreach ($arr[1] as $value) {
                $brand      = (mb_stripos($value, 'Бренд:', 0, 'UTF-8') !== false) ? $value : $brand;
                $model      = (mb_stripos($value, 'Модель:', 0, 'UTF-8') !== false) ? $value : $model;
                $type       = (mb_stripos($value, 'Тип:', 0, 'UTF-8') !== false) ? $value : $type;
                $purpose    = (mb_stripos($value, 'Назначение:', 0, 'UTF-8') !== false) ? $value : $purpose;
                $material   = (mb_stripos($value, 'Материал:', 0, 'UTF-8') !== false) ? $value : $material;
                $color      = (mb_stripos($value, 'Цвет:', 0, 'UTF-8') !== false) ? $value : $color;
                $coin       = (mb_stripos($value, 'Застежка:', 0, 'UTF-8') !== false) ? $value : $coin;
                $depart     = (mb_stripos($value, 'Отделение для монет:', 0, 'UTF-8') !== false) ? $value : $depart;
                $depart2    = (mb_stripos(
                        $value, 'Отделения для карт/визиток:', 0, 'UTF-8'
                    ) !== false) ? $value : $depart2;
                $country    = (mb_stripos($value, 'Страна производства:', 0, 'UTF-8') !== false) ? $value : $country;
                $dimensions = (mb_stripos($value, 'Размеры:', 0, 'UTF-8') !== false) ? $value : $dimensions;
                $additional = (mb_stripos(
                        $value, 'Дополнительная информация:', 0, 'UTF-8'
                    ) !== false) ? $value : $additional;
                $articulMan = (mb_stripos(
                        $value, 'Артикул производителя:', 0, 'UTF-8'
                    ) !== false) ? $value : $articulMan;
            }
            $subcategories = DB::table('subcategories_products')
                               ->where('product_id', $product->id)
                               ->pluck('subcategory_id')
                               ->toArray()
            ;
            $subcategories = Subcategory::query()
                                        ->whereIn('id', $subcategories)
                                        ->get()
                                        ->pluck('title')
                                        ->toArray()
            ;
            $subcategories = implode(', ', $subcategories);

            $complete = CompleteCategory::query()
                                        ->where('id', $product->complete_id)
                                        ->take(1)
                                        ->get()
                                        ->pluck('title')
                                        ->toArray()
            ;

            $ids  = DB::table('complete_products')
                      ->where('product_id', $product->id)
                      ->get()
                      ->pluck('complete_id')
                      ->toArray()
            ;
            $prod = Product::query()
                           ->whereIn('id', $ids)
                           ->get()
                           ->pluck('title')
                           ->toArray()
            ;
            $prod = implode(', ', $prod);

            $data[] = [
                '0'  => $product->code,
                '1'  => $product->title,
                '2'  => $brand,
                '3'  => $product->code,
                '4'  => $model,
                '5'  => $product->video,
                '6'  => $type,
                '7'  => $purpose,
                '8'  => $material,
                '9'  => $color,
                '10' => $coin,
                '11' => $depart,
                '12' => $depart2,
                '13' => $country,
                '14' => $dimensions,
                '15' => $additional,
                '16' => $articulMan,
                '17' => $product->price,
                '18' => $subcategories,
                '19' => $complete[0] ?? '',
                '20' => $prod,
                '21' => $product->remainder,
                '22' => strip_tags($product->description),
                '23' => ($product->is_constructor == 1) ? 'Да' : 'Нет',
                '24' => $product->code,
                '25' => $product->code,
                '26' => $product->seo_title,
                '27' => $product->seo_description,
                '28' => $product->seo_content,
            ];
        }

        return $data;
    }
}


