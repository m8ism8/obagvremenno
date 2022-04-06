<?php

namespace App\Imports;

use App\Models\CompleteCategory;
use App\Models\ElementProduct;
use App\Models\FilterElement;
use App\Models\Product;
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



                    //TODO subcategory_id СЮДА сделать сабкатегорию
                    $product = Product::create([
                        'code'  => $row[0],
                        'title' => $row[1],
                        'price' => $row[19],
                        'characteristics' => $characteristics,
                        'description' => $description,
                        'image' => 'products/' . $row[3],
                        'video' => $row[4],

                        'subcategory_id' => '',

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

                    //TODO Сюда 'category_id' => 5 id категории фильтра
                    $element = FilterElement::query()->create([
                        'category_id' => 5,
                        'title'       => $row[6]
                    ]);

                    ElementProduct::query()
                        ->create([
                            'element_id' => $element->id,
                            'product_id' => $product->id
                        ]);
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
