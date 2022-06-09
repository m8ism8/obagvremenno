<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\{
    Product
};

class UpdateExcel implements ToCollection
{
    public function collection(Collection $rows): array
    {
        foreach ($rows as $row) {
            if ($row[0] == 'Артикул' or $row[0] == null) {
                continue;
            } else {

                $check = Product::query()
                                ->where('code', $row[0])
                ;
                if (!$check->exists()) {
                    continue;
                } else {
                    $product     = $check->first();
                    $code        = $row[0];
                    $price       = $row[1] ?? $product->price;
                    $remainder   = $row[2] ?? $product->remainder;
                    $new_price   = $row[3] ?? $product->new_price;
                    $title       = $row[4] ?? $product->title;
                    $description = $row[5] ?? $product->description;
                    $content     = $row[6] ?? $product->content;

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
