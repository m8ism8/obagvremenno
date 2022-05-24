<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromArray
{
    public function array(): array
    {
        $products = Product::all();
        $data = [];
        $data[] = [
            '0' => 'Артикул',
            '1' => 'Название товара',
            '2' => 'Бренд',
            '3' => 'Код изображений',
            '4' => 'Модель',
            '5' => 'Ссылка на Youtube',
            '6'  => 'Тип',
            '7'  => 'Назначение',
            '8'  => 'Материал',
            '9'  => 'Цвет',
            '10'  => 'Застежка',
            '11'  => 'Отделение для монет',
            '12'  => 'Отделения для карт/визиток',
            '13'  => 'Страна производства',
            '14'  => 'Размеры',
            '15'  => 'Дополнительная информация',
            '16'  => 'Артикул производителя',
            '17'  => 'Цена',
            '18'  => 'Подкатегория продукта',
            '19'  => 'Категории комплектующие',
            '20'  => 'Комплектующие',
            '21'  => 'Остатки',
            '22'  => 'Описание',
            '23'  => 'Конструктор',
            '24'  => 'Конструктор картинка',
        ];
        foreach ($products as $product) {
            $data[] = [
                'code' => $product->code,
                'title'  => $product->title,
            ];
        }
        return $data;
    }
}
