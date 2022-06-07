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

class UpdateExcel implements ToCollection
{
    public function collection(Collection $rows): array
    {
        foreach ($rows as $row) {
            if ($row[0] == 'Артикул' or $row[0] == null) {

            } else {

                $check = Product::query()
                                ->where('code', $row[0])
                ;
                if (!$check->exists()) {
                } else {
                    $product     = $check->first();
                    $code        = $row[0];
                    $price       = $row[1] ?? $product->price;
                    $remainder   = $row[2] ?? $product->price;
                    $new_price   = $row[3] ?? $product->price;
                    $title       = $row[4] ?? $product->price;
                    $description = $row[5] ?? $product->price;
                    $content     = $row[6] ?? $product->price;

                    Product::query()
                           ->where('code', $code)
                           ->update([
                                        'price'           => $price,
                                        'remainder'       => $remainder,
                                        'seo_title'       => $title,
                                        'seo_description' => $description,
                                        'seo_content'     => $content,
                                        'new_price'       => $new_price,
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
