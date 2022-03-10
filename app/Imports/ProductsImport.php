<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\{
    Category, Subcategory, Product
};

class ProductsImport implements ToCollection
{
    // 0 title
    // 1 code
    // 2 price
    // 3 new_price
    // 4 badge
    // 5 available
    // 6 characteristics
    // 7 description
    // 8 image
    // 9 video
    // 10 category title
    // 11 subcategory title
    public function collection(Collection $rows)
    {
        foreach($rows as $row) {
            if($row[0]=='Название') {}
            else {
                try {
                    $category = Category::where('title', $row[10])->firstOrCreate([
                        'title' => $row[10],
                        'full_title' => $row[10]
                    ]);
                    $subcategory = Subcategory::where('title', $row[11])->where('category_id', $category->id)->firstOrCreate([
                        'title' => $row[11],
                        'category_id' => $category->id
                    ]);
                    $characteristics = '<p>'.$row[6].'</p>';
                    $description = '<p>'.$row[7].'</p>';
                    $product = Product::create([
                        'title' => $row[0],
                        'code' => $row[1],
                        'price' => $row[2],
                        'new_price' => $row[3] ?? null,
                        'badge' => $row[4] ?? null,
                        'available' => $row[5],
                        'characteristics' => $characteristics,
                        'description' => $description,
                        'image' => $row[8] ?? null,
                        'video' => $row[9] ?? null,
                        'subcategory_id' => $subcategory->id
                    ]);
                }
                catch (\Exception $e) {}
            }
        }
        return [
            'message' => 'done'
        ];
    }
}
