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
                                ->exists()
                ;
                if (!$check) {
                    dd(1);
                } else {
                    $code      = $row[0];
                    $price     = $row[1];
                    $remainder = $row[2];
                    Product::query()
                           ->where('code', $code)
                           ->update(['price' => $price, 'remainder' => $remainder])
                    ;
                }
            }
        }

        return [
            'message' => 'done',
        ];
    }

}
