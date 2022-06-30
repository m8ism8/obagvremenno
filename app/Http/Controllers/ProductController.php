<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;
use App\Models\{CompleteCategory,
    CompleteProduct,
    ElementProduct,
    NewSales,
    Product,
    Category,
    SubcategoriesProduct,
    Subcategory,
    Sale,
    Favourite,
    FilterCategory,
    FilterElement,
    Certificate
};

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Resources\{
    ProductResource,
    SaleResource,
    RecomendedResource,
    CategoryResource,
    CategoriesResource,
    SubcategoryResource,
    CertificateResource,
};

class ProductController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport(), 'products.xlsx');
    }

    /** @noinspection HtmlUnknownTag */
    public function xml()
    {
        $xml = '<?xml version="1.0" encoding="windows-1251"?>';
        $xml .= 'DOCTYPE yml_catalog SYSTEM "shops.dtd">';
        $xml .= 'DOCTYPE yml_catalog SYSTEM "shops.dtd">';
        $xml .= '<yml_catalog date="2016-11-21 11:01">';
        $xml .= '<shop>';
        $xml .= '<name>CompanyName</name>';
        $xml .= '<company>CompanyName</company>';
        $xml .= '<url>http://yourweb.ru</url>';


        $categories    = Category::query()
                                 ->select(
                                     'id',
                                     'title',
                                 )
                                 ->get()
                                 ->where('id', '!=', 1000000)
                                 ->toArray()
        ;
        $categoriesXML = '';
        foreach ($categories as $category) {
            $categoriesXML .= '<category id="' . $category['id'] . '">' . $category['title'] . '</category>' . "\n";
        }

        $xml .= '<categories>';
        $xml .= $categoriesXML;
        $xml .= '</categories>';

        $xml         .= '<offers>';
        $productsXML = '';

        $products = Product::query()
                           ->select(
                               'price',
                               'new_price',
                               'image',
                               'title',
                               'id',
                               'remainder',
                               'code',
                               'description'
                           )
                           ->get()
                           ->take(5)
                           ->toArray()
        ;
        foreach ($products as $product) {
            $categoryId = SubcategoriesProduct::query()
                                              ->select(
                                                  'subcategory_id'
                                              )
                                              ->where('product_id', $product['id'])
                                              ->first()
                ->subcategory_id;
            $categoryId = Subcategory::query()
                                     ->where('id', $categoryId)
                                     ->first()->category_id;

            $productsXML .= '<offer id="' . $product['id'] . '" available="true">';
            $productsXML .= '<url>http://yourweb.ru/product/' . $product['id'] . '</url>';

            if (json_decode($product['image'])) {
                $product['image'] = json_decode($product['image'], true)[0];
            } else {
            }

            if ($product['price'] == null) {
                $productsXML .= '<price>' . $product['price'] . '</price>';
            } else {
                $productsXML .= '<price>' . $product['new_price'] . '</price>';
            }
            $productsXML .= '<oldprice>' . $product['price'] . '</oldprice>';

            $stored = ($product['remainder'] > 1) ? 'true' : 'false';

            $elemets = ElementProduct::query()
                                     ->where('product_id', $product['id'])
                                     ->select('element_id')
                                     ->pluck('element_id')
            ;

            $filters = FilterElement::query()
                                    ->whereIn('id', $elemets)
                                    ->get()
                                    ->toArray()
            ;

            for ($i = 0; $i < count($filters); $i++) {
                $filters[$i]['category_name'] = FilterCategory::query()
                                                              ->where('id', $filters[$i]['category_id'])
                                                              ->first()
                    ->title;
            }


            $productsXML .= '<currencyId>KZT</currencyId>';
            $productsXML .= '<categoryId>' . $categoryId . '</categoryId>';
            $productsXML .= '<picture>' . env('APP_URL') . '/storage/' . $product['image'] . '</picture>';
            $productsXML .= '<store>' . $product['title'] . '</store>';
            $productsXML .= '<pickup>' . $stored . '</pickup>';
            $productsXML .= '<delivery>' . $stored . '</delivery>';
            $productsXML .= '<local_delivery_cost>' . 0 . '</local_delivery_cost>';
            $productsXML .= '<name>' . $product['title'] . '</name>';
            $productsXML .= '<model>' . $product['title'] . '</model>';
            $productsXML .= '<vendor>' . 'Obag' . '</vendor>';
            $productsXML .= '<vendorCode>' . $product['code'] . '</vendorCode>';
            $productsXML .= '<typePrefix>' . $categoryId . '</typePrefix>';
            $productsXML .= '<sales_notes>' . 1000 . '</sales_notes>';
            $productsXML .= '<description>' . $product['description'] . '</description>';

            foreach ($filters as $filter) {
                $productsXML .= '<param name="' . $filter['category_name'] . '">' . $filter['title'] . '</param>';
            }
            $productsXML .= '<param>' . $product['title'] . '</param>';

            $productsXML .= '</offer>';
            $xml         .= $productsXML;
        }
        $xml .= '</offers>';
        $xml .= '</shop>';
        $xml .= '</yml_catalog>';

        return response($xml);
    }

    /**
     * @throws \Exception
     */
    private function arrayToXml($array, $rootElement = null, $xml = null)
    {
        $_xml = $xml;

        // If there is no Root Element then insert root
        if ($_xml === null) {
            $_xml = new \SimpleXMLElement($rootElement !== null ? $rootElement : '<root/>');
        }

        // Visit all key value pair
        foreach ($array as $k => $v) {

            // If there is nested array then
            if (is_array($v)) {

                // Call function for nested array
                $this->arrayToXml($v, $k, $_xml->addChild($k));
            } else {

                // Simply add child element.
                $_xml->addChild($k, $v);
            }
        }

        return $_xml->asXML();
    }

    public function promotional($sort = null)
    {
        $productsId = DB::table('sale_products')
                        ->get()
                        ->pluck('product_id')
                        ->toArray()
        ;
        if ($sort != null) {
            $products = Product::query()
                               ->select(
                                   'id',
                                   'title',
                                   'code',
                                   'price',
                                   'new_price',
                                   'image',
                                   'remainder',
                               )
                               ->whereIn('id', $productsId)
                               ->orderBy('price', $sort)
                               ->get()
                               ->translate(\request()->header('Accept-Language'))
            ;
        } else {
            $products = Product::query()
                               ->select(
                                   'id',
                                   'title',
                                   'code',
                                   'price',
                                   'new_price',
                                   'image',
                                   'remainder',
                               )
                               ->whereIn('id', $productsId)
                               ->get()
                               ->translate(\request()->header('Accept-Language'))
            ;
        }
        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                                            ->where('product_id', $product->id)
                                            ->where(
                                                'user_id', Auth::guard('sanctum')
                                                               ->id()
                                            )
                                            ->exists()
            ;
            $images              = json_decode($product->image);

            if ($product->translations->isEmpty()) {
                $product = $product->translate('ru');
            }

            if ($images) {
                $product->image = env('APP_URL') . '/storage/' . $images[0];
            } else {
                $product->image = env('APP_URL') . '/storage/' . $product->image;
            }
            $product->slug = Str::slug($product->title);
        }

        return $products;
    }

    public function getRecomended()
    {
        $data             = [];
        $randomCategories = Subcategory::query()
                                       ->where('is_top', true)
                                       ->get()
        ;

        if (count($randomCategories) > 0) {
            $count = count($randomCategories[0]->products);
            if ($count) {
                if ($count > 4) {
                    $count = 4;
                }
                $randomProductsIds1 = $randomCategories[0]->products->pluck('id')
                                                                    ->random($count)
                ;
                $randomProducts1    = Product::whereIn('id', $randomProductsIds1)
                                             ->get()
                ;
                $data[]             = [
                    'title'    => $randomCategories[0]->title,
                    'products' => $this->addImageLink($randomProducts1),
                ];
            }
        } else {
            $randomProducts1 = null;
        }

        if (count($randomCategories) > 1) {
            $count = count($randomCategories[1]->products);
            if ($count > 0) {
                if ($count > 4) {
                    $count = 4;
                }
                $randomProductsIds2 = $randomCategories[1]->products->pluck('id')
                                                                    ->random($count)
                ;
                $randomProducts2    = Product::whereIn('id', $randomProductsIds2)
                                             ->get()
                ;
                $data[]             = [
                    'title'    => $randomCategories[1]->title,
                    'products' => $this->addImageLink($randomProducts2),
                ];
            }
        } else {
            $randomProducts2 = null;
        }

        $newestProducts  = Product::query()
                                  ->where('is_new', true)
                                  ->orderBy('created_at', 'desc')
                                  ->get()
        ;
        $popularProducts = Product::query()
                                  ->where('is_popular', true)
                                  ->orderBy('created_at', 'desc')
                                  ->get()
        ;

        $data[] = [
            'title'    => 'Новинки',
            'products' => $this->addImageLink($newestProducts),
        ];
        $data[] = [
            'title'    => 'Популярное',
            'products' => $this->addImageLink($popularProducts),
        ];

//        $recomendedProducts = collect([
//                                          [
//                                              'title'    => $randomCategories[0]->title,
//                                              'products' => $this->addImageLink($randomProducts1),
//                                          ],
//                                          [
//                                              'title'    => $randomCategories[1]->title,
//                                              'products' => $this->addImageLink($randomProducts2),
//                                          ],
//                                          [
//                                              'title'    => 'Новинки',
//                                              'products' => $this->addImageLink($newestProducts),
//                                          ],
//                                          [
//                                              'title'    => 'Популярное',
//                                              'products' => $this->addImageLink($popularProducts),
//                                          ],
//                                      ]);

        $recomendedProducts = collect($data);


        return response()->json(['recomendedProducts' => $recomendedProducts]);
    }

    public function addImageLink($collection)
    {
        foreach ($collection as $item) {
            $item->isFavorite = Favourite::query()
                                         ->where('product_id', $item->id)
                                         ->where(
                                             'user_id', Auth::guard('sanctum')
                                                            ->id()
                                         )
                                         ->exists()
            ;
            $item->slug       = Str::slug($item->title);
            if ($item->image && str_split($item->image, 4)[0] != 'http') {
                if (json_decode($item->image, true) != null) {
                    $item->image = env('APP_URL') . '/storage/' . json_decode($item->image, true)[0];
                } else {
                    $item->image = env('APP_URL') . '/storage/' . $item->image;
                }
            }
        }

        return $collection;
    }

    public function getFilters($products)
    {
        $filterElementsIds = [];
        foreach ($products as $product) {
            $product->filterElements;
            if ($product->filterElements) {
                foreach ($product->filterElements as $element) {
                    if (!in_array($element->id, $filterElementsIds)) {
                        $filterElementsIds[] = $element->id;
                    }
                }
            }
        }
        $filters              = FilterElement::whereIn('id', $filterElementsIds)
                                             ->get()
        ;
        $filterFinal          = [];
        $filterCategoriesUsed = [];
        foreach ($filters as $filter) {
            $category = FilterCategory::find($filter->category_id);
            if (!in_array($filter->category_id, $filterCategoriesUsed)) {
                $filterCategoriesUsed[]        = $filter->category_id;
                $filterFinal[$category->title] = [$filter];
            } else {
                array_push($filterFinal[$category->title], $filter);
            }
        }

        return $filterFinal;
    }

    public function index()
    {
        $banner = [
            'image' => env('APP_URL') . '/storage/' . setting('main-banner.image'),
            'link'  => setting('main-banner.link'),
        ];

        $mainSale = Sale::query()
                        ->where('is_main', 1)
                        ->orderBy('created_at', 'desc')
                        ->take(1)
                        ->with('products')
                        ->first()
                        ->translate(\request()->header('Accept-Language'))
        ;
        if ($mainSale->translations->isEmpty()) {
            $mainSale->translate('ru');
        }
        $sales = Sale::query()
                     ->where('is_sub_main', 1)
                     ->take(2)
                     ->get()
                     ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($sales as $sale) {
            if ($sale->translations->isEmpty()) {
                $sale->translate('ru');
            }
        }

        $salesMore = Sale::query()
                         ->select(
                             'id',
                             'title',
                             'subtitle',
                             'badge',
                             'image',
                             'text',
                             'created_at',
                             'preview_image'
                         )
                         ->orderBy('created_at', 'desc')
                         ->take(4)
                         ->get()
                         ->translate(\request()->header('Accept-Language'))
        ;

        $news = NewSales::query()
                        ->select(
                            'id',
                            'title',
                            'subtitle',
                            'image',
                        )
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get()
                        ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($news as $new) {
            if ($new->translations->isEmpty()) {
                $new->translate('ru');
            }
            $new->image = env('APP_URL') . '/storage/' . $new->image;
        }
        foreach ($salesMore as $salesMoreproduct) {
            if ($salesMoreproduct->translations->isEmpty()) {
                $salesMoreproduct->translate('ru');
            }
            if ($salesMoreproduct->preview_image != null) {
                $salesMoreproduct->preview_image = env('APP_URL') . '/storage/' . $salesMoreproduct->preview_image;
            }
            $salesMoreproduct->image = env('APP_URL') . '/storage/' . $salesMoreproduct->image;
        }

        return response()->json([
                                    'banner'      => $banner,
                                    'mainSale'    => new SaleResource($mainSale),
                                    'secondSales' => SaleResource::collection($sales),
                                    'sales'       => $salesMore,
                                    'news'        => $news,
                                ]);
    }

    public function getcategories()
    {
        $categories = category::with('subcategories')
                              ->where('id', '!=', 1000000)
                              ->get()
                              ->translate(\request()->header('Accept-Language'))
        ;

        $categories = CategoriesResource::collection($categories);
        $categories->prepend(
            collect([
                        'id'            => 1000000,
                        'title'         => 'Акции',
                        'full_title'    => 'test',
                        'text'          => 'test',
                        'image'         => env(
                                'APP_URL'
                            ) . '/storage/' . 'categories/February2022/mnjmRWae7dI8LSLHdiEP.png',
                        'subcategories' => [],
                    ])
        );

        return response()->json([
                                    'categories' => $categories,
                                ]);
    }

    public function category(Category $category)
    {
        if ($category->id == 1000000) {
            $category = collect([
                                    'id'            => 1000000,
                                    'title'         => 'Акции',
                                    'full_title'    => 'test',
                                    'text'          => 'test',
                                    'image'         => env(
                                            'APP_URL'
                                        ) . '/storage/' . 'categories/February2022/mnjmRWae7dI8LSLHdiEP.png',
                                    'subcategories' => [],
                                    'products'      => $this->promotional(\request()->input('sort_price')),
                                    'constructor'   => [],
                                ]);

            return response()->json([
                                        'filters'  => [],
                                        'category' => $category,
                                        'sales'    => [],
                                    ]);
        }

        $sales = Sale::all()
                     ->translate(\request()->header('Accept-Language'))
        ;

        foreach ($sales as $sale) {
            if ($sale->translations->isEmpty()) {
                $sale->translate('ru');
            }
        }

        $subcategoriesIds = Subcategory::query()
                                       ->where('category_id', $category->id)
                                       ->select('id', 'preview_image')
                                       ->get()
                                       ->pluck('id')
                                       ->toArray()
        ;

        $productsIds = SubcategoriesProduct::query()
                                           ->whereIn('subcategory_id', $subcategoriesIds)
                                           ->get()
                                           ->pluck('product_id')
                                           ->toArray()
        ;

        if (\request()->input('sales') == true) {
            $products = Product::query()
                               ->whereNotNull('new_price')
                               ->whereIn('id', $productsIds)
                               ->get()
                               ->translate(\request()->header('Accept-Language'))
            ;
        } else {
            $products = Product::query()
                               ->whereIn('id', $productsIds)
                               ->get()
                               ->translate(\request()->header('Accept-Language'))
            ;
        }


        foreach ($products as $product) {
            if ($product->translations->isEmpty()) {
                $product->translate('ru');
            }
        }

        $category->products = $products;
        $filters            = $this->getFilters($category->products);
        $category->subcategories;
        //->translate(\request()->header('Accept-Language'));
        $category->constructor;

        //->translate(\request()->header('Accept-Language'));

        return response()->json([
                                    'filters'  => $filters,
                                    'category' => new CategoryResource($category),
                                    'sales'    => SaleResource::collection($sales),
                                ]);
    }

    public function categoryFiltered(category $category, Request $request)
    {
        $subcategoriesIds = Subcategory::query()
                                       ->where('category_id', $category->id)
                                       ->select('id')
                                       ->get()
                                       ->pluck('id')
                                       ->toArray()
        ;

        $productsIds = SubcategoriesProduct::query()
                                           ->whereIn('subcategory_id', $subcategoriesIds)
                                           ->get()
                                           ->pluck('product_id')
                                           ->toArray()
        ;

        $products = Product::query()
                           ->whereIn('id', $productsIds)
                           ->get()
        ;

        foreach ($products as $product) {
            $product->actualPrice = $product->new_price ?? $product->price;
        }
        if ($request->price_from) {
            $products = $products->where('actualPrice', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $products = $products->where('actualPrice', '<=', $request->price_to);
        }

        if ($request->ids) {
            $ids        = $request->ids;
            $productIds = [];
            foreach ($products as $product) {
                $product->filterElements;
                foreach ($product->filterElements as $element) {
                    if (in_array($element->id, $ids) && !in_array($product->id, $productIds)) {
                        array_push($productIds, $product->id);
                    }
                }
            }
        } else {
            $productIds = $products->pluck('id');
        }
        $products = Product::whereIn('id', $productIds)
                           ->get()
        ;


        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                                            ->where('product_id', $product->id)
                                            ->where(
                                                'user_id', Auth::guard('sanctum')
                                                               ->id()
                                            )
                                            ->exists()
            ;
            $images              = json_decode($product->image);
            if ($images) {
                $product->image = env('APP_URL') . '/storage/' . $images[0];
            } else {
                $product->image = env('APP_URL') . '/storage/' . $product->image;
            }
            $product->slug = Str::slug($product->title);
        }

        if ($request->sort_price) {
            $sort     = $request->sort_price;
            $sort     = strtolower($sort);
            $products = $products->sortBy([
                                              [
                                                  'price', $sort,
                                              ],
                                          ]);
        }


        return response()->json([
                                    'products' => $products,
                                ]);
    }

    public function subcategory(Subcategory $subcategory)
    {
        if (request()->has('sort_price')) {
            $subcategory->product = $subcategory->products->sortBy([
                                                                       [
                                                                           'price', request()->input('sort_price'),
                                                                       ],
                                                                   ]);
        }
        $sales             = Sale::all();
        $filters           = $this->getFilters($subcategory->products);
        $subcategory->slug = Str::slug($subcategory->title);

        foreach ($subcategory->products as $product) {
            if (json_decode($product->image) != null) {
                $product->image = env('APP_URL') . '/storage/' . json_decode($product->image, true)[0];
            } else {
                $product->image = env('APP_URL') . '/storage/' . $product->image;
            }
            $product->slug       = Str::slug($product->title);
            $product->isFavorite = Favourite::query()
                                            ->where('product_id', $product->id)
                                            ->where(
                                                'user_id', Auth::guard('sanctum')
                                                               ->id()
                                            )
                                            ->exists()
            ;
        }

        $completes = CompleteCategory::query()
                                     ->where('subcategory_id', $subcategory->id)
                                     ->get()
        ;

        foreach ($completes as $complete) {
            $complete->image = env('APP_URL') . '/storage/' . $complete->image;
        }
        $subcategory->image = env('APP_URL') . '/storage/' . $subcategory->image;
        try {
            $subcategory->preview_image = json_decode($subcategory->preview_image, true)[0];
            $subcategory->preview_image = env('APP_URL') . '/storage/' . $subcategory->preview_image['download_link'];
        } catch (\Exception $exception) {
            $subcategory->preview_image = null;
        }

        return response()->json([
                                    'subcategory' => $subcategory,
                                    'completes'   => $completes,
                                    'filters'     => $filters,
                                    'sales'       => SaleResource::collection($sales),
                                ]);
    }

    public function subcategoryFiltered(Subcategory $subcategory, Request $request)
    {

        if (isset($request->complete_id)) {
            $products = Product::query()
                               ->where('complete_id', $request->complete_id)
                               ->get()
            ;
        } else {
            $products = $subcategory->products()
                                    ->get()
            ;
        }

        foreach ($products as $product) {
            $product->actualPrice = $product->new_price ?? $product->price;
        }
        if ($request->price_from) {
            $products = $products->where('actualPrice', '>=', $request->price_from);
        }
        if ($request->price_to) {
            $products = $products->where('actualPrice', '<=', $request->price_to);
        }

        if ($request->ids) {
            $ids        = $request->ids;
            $productIds = [];
            foreach ($products as $product) {
                $product->filterElements;
                foreach ($product->filterElements as $element) {
                    if (in_array($element->id, $ids) && !in_array($product->id, $productIds)) {
                        array_push($productIds, $product->id);
                    }
                }
            }
        } else {
            $productIds = $products->pluck('id');
        }
        $products = Product::whereIn('id', $productIds)
                           ->get()
        ;

        foreach ($products as $product) {
            $product->isFavorite = Favourite::query()
                                            ->where('product_id', $product->id)
                                            ->where(
                                                'user_id', Auth::guard('sanctum')
                                                               ->id()
                                            )
                                            ->exists()
            ;
            $images              = json_decode($product->image);
            if ($images) {
                $product->image = env('APP_URL') . '/storage/' . $images[0];
            } else {
                $product->image = env('APP_URL') . '/storage/' . $product->image;
            }
            $product->slug = Str::slug($product->title);
        }

        if ($request->sort_price) {
            $sort     = $request->sort_price;
            $sort     = strtolower($sort);
            $products = $products->sortBy([
                                              [
                                                  'price', $sort,
                                              ],
                                          ]);
        }


        return response()->json([
                                    'products' => $products,
                                ]);
    }

    public function product(Product $product)
    {
        $product->filterElements;
        $product->reviews;

        $complete = CompleteProduct::query()
                                   ->where('product_id', $product->id)
                                   ->join('products', 'products.id', '=', 'complete_products.complete_id')
                                   ->select('products.*')
                                   ->get()
                                   ->translate(\request()->header('Accept-Language'))
        ;


        foreach ($complete as $item) {
            if (json_decode($item->image, true) != null) {
                $item->image = json_decode($item->image, true);
                $item->image = env('APP_URL') . '/storage/' . $item->image[0];
            } else {
                $item->image = env('APP_URL') . '/storage/' . $item->image;
            }
        }

        $product->complete = $complete;

        $product->isFavorite = Favourite::query()
                                        ->where('product_id', $product->id)
                                        ->where(
                                            'user_id', Auth::guard('sanctum')
                                                           ->id()
                                        )
                                        ->exists()
        ;

        $product->getProducts = true;

        $product->translate(\request()->header('Accept-Language'));

        return response()->json([
                                    'product' => new ProductResource($product),
                                ]);
    }

    public function favourite($id)
    {
        $favourite = Favourite::where('user_id', Auth()->id())
                              ->where('product_id', $id)
                              ->firstOrCreate([
                                                  'user_id'    => Auth()->id(),
                                                  'product_id' => $id,
                                              ])
        ;

        return response()->json([
                                    'favourite' => $favourite,
                                ]);
    }

    public function favouriteDelete($id)
    {

        $favorite = Favourite::query()
                             ->where('user_id', Auth::id())
                             ->where('product_id', $id)
                             ->first()
        ;
        if (!isset($favorite)) {
            return response()->json(
                [
                    'message' => 'Товара нет в корзине',
                ], 422
            );
        }

        $favorite->delete();

        return response()->json([
                                    'message' => 'Товар успешно удален',
                                ], 200);
    }

    public function search($string)
    {
        $products = Product::query()
                           ->where('title', 'LIKE', '%' . $string . '%')
                           ->orWhere('code', 'LIKE', '%' . $string . '%')
                           ->get()
                           ->translate(\request()->header('Accept-Language'))
        ;

        foreach ($products as $product) {
            if ($product->translations->isEmpty()) {
                $product = $product->translate('ru');
            }
            $product->isFavorite = Favourite::query()
                                            ->where('product_id', $product->id)
                                            ->where(
                                                'user_id', Auth::guard('sanctum')
                                                               ->id()
                                            )
                                            ->exists()
            ;
        }

        return response()->json([
                                    'products' => ProductResource::collection($products),
                                ]);
    }

    public function certificates()
    {
        $certificates = Certificate::all();

        return response()->json([
                                    'certificates' => CertificateResource::collection($certificates),
                                ]);
    }
}
