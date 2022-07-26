<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\AffiliateStore;
use App\Models\AllAboutProduct;
use App\Models\BrandInformation;
use App\Models\CorporateInformation;
use App\Models\ExploitationArticle;
use App\Models\GiftRule;
use App\Models\Guarantee;
use App\Models\HistoryMission;
use App\Models\LoyaltySystem;
use App\Models\MobileShoppingContent;
use App\Models\MobileShoppingStore;
use App\Models\Product;
use App\Models\ProductInformation;
use App\Models\ResearchInnovation;
use App\Models\ReturnInformation;
use App\Models\RuleOperation;
use App\Models\SaveYourObag;
use App\Models\Seo;
use App\Models\ShippingPayment;
use App\Models\SocialMission;
use App\Models\StoresKazakhstan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class InformationPageController extends Controller
{
    public function seo(string $seo)
    {
        $seo = Seo::query()
                  ->where('slug', $seo)
                  ->select('slug', 'title', 'description', 'content')
                  ->first()
        ;

        if ($seo == null) {
            return response()->json([
                                        'message' => 'Не найдено',
                                    ], 404);
        }


        return response()->json([
                                    'title'       => $seo->title,
                                    'description' => $seo->description,
                                    'content'     => $seo->content,
                                ]);
    }

    public function exploitationAccessories()
    {
        $data = ExploitationArticle::query()
                                   ->select('id', 'title', 'image', 'subtitle')
                                   ->get()
                                   ->translate(\request()->header('Accept-Language'))
        ;

        foreach ($data as $item) {
            if ($item->translations->isEmpty()) {
                $item->translate('ru');
            }
            $item->image = asset('storage/' . $item->image);
            $item->slug  = Str::slug($item->title);
        }

        return response()->json($data);
    }

    public function giftCertificates()
    {
        $data = Product::query()
                       ->where('is_certificate', true)
                       ->get()
                       ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($data as $item) {
            if ($item->translations->isEmpty()) {
                $item->translate('ru');
            }
        }
        $data = ProductResource::collection($data);

        return response()->json($data);
    }

    public function exploitationAccessoriesById(int $id)
    {
        $data        = ExploitationArticle::query()
                                          ->where('id', $id)
                                          ->first()
        ;
        $data->image = asset('storage/' . $data->image);

        return response()->json($data);
    }

    public function seoParser(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $data = $data['options'];

        foreach ($data as $key => $value) {
            Seo::query()
               ->create([
                            'slug'    => $key,
                            'hid'     => 'test',
                            'name'    => 'test',
                            'content' => 'test',
                        ])
            ;
        }
    }

    public function saveYourObag()
    {
        $language = \request()->header('Accept-Language');

        $content = SaveYourObag::all('title', 'link')
                               ->translate($language)
        ;

        return response()->json($content);
    }

    public function historyMission(): JsonResponse
    {
        $language = \request()->header('Accept-Language');

        $content = HistoryMission::query()
                                 ->first()
                                 ->translate($language)
        ;

        if ($content->translations->isEmpty()) {
            $content = HistoryMission::query()
                                     ->first()
                                     ->translate('ru')
            ;
        }
        $content->main_image   = env('APP_URL') . '/storage/' . $content->main_image;
        $content->image_first  = env('APP_URL') . '/storage/' . $content->image_first;
        $content->image_second = env('APP_URL') . '/storage/' . $content->main_image;
        $content->images       = env('APP_URL') . '/storage/' . $content->main_image;

        return response()->json($content);
    }

    public function socialMission(): JsonResponse
    {
        $content = SocialMission::query()
                                ->first()
                                ->translate(\request()->header('Accept-Language'))
        ;

        if ($content->translations->isEmpty()) {
            $content = SocialMission::query()
                                    ->first()
                                    ->translate('ru')
            ;
        }

        $content->main_image   = env('APP_URL') . '/storage/' . $content->main_image;
        $content->image_first  = env('APP_URL') . '/storage/' . $content->image_first;
        $content->image_second = env('APP_URL') . '/storage/' . $content->main_image;
        $content->image_third  = env('APP_URL') . '/storage/' . $content->main_image;
        $content->image_fourth = env('APP_URL') . '/storage/' . $content->image_fourth;

        return response()->json($content);
    }

    public function brandInformation(): JsonResponse
    {
        $content = BrandInformation::query()
                                   ->first()
                                   ->translate(\request()->header('Accept-Language'))
        ;

        if ($content->translations->isEmpty()) {
            $content = BrandInformation::query()
                                       ->first()
                                       ->translate('ru')
            ;
        }

        return response()->json($content);
    }

    public function productInformation(): JsonResponse
    {
        $data = ProductInformation::query()
                                  ->get()
                                  ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($data as $content) {
            $content->image = env('APP_URL') . '/storage/' . $content->image;
            if ($content->translations->isEmpty()) {
                $content->translate('ru');
            }
        }

        return response()->json($data);
    }

    public function allAboutProducts(): JsonResponse
    {
        $content = AllAboutProduct::query()
                                  ->first()
                                  ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }
        $content->image = env('APP_URL') . '/storage/' . $content->image;

        return response()->json($content);
    }

    public function researchInnovation(): JsonResponse
    {
        $content = ResearchInnovation::query()
                                     ->first()
                                     ->translate(\request()->header('Accept-Language'))
        ;

        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function shippingPayment(): JsonResponse
    {
        $content = ShippingPayment::query()
                                  ->first()
                                  ->translate(\request()->header('Accept-Language'))
        ;

        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        $images = json_decode($content->images, true);
        $img    = [];
        foreach ($images as $image) {
            $image = env('APP_URL') . '/storage/' . $image;
            $img[] = $image;
        }
        $content->images = $img;

        return response()->json($content);
    }

    public function returnInformation(): JsonResponse
    {
        $content = ReturnInformation::query()
                                    ->first()
                                    ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function loyaltySystem(): JsonResponse
    {
        $content = LoyaltySystem::query()
                                ->first()
                                ->translate(\request()->header('Accept-Language'))
        ;

        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function corporateInformation(): JsonResponse
    {
        //TODO сделать блоки
        $content = CorporateInformation::query()
                                       ->first()
                                       ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function giftRule(): JsonResponse
    {
        $content        = GiftRule::query()
                                  ->first()
                                  ->translate(\request()->header('Accept-Language'))
        ;
        $content->image = env('APP_URL') . '/storage/' . $content->image;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function guarantee(): JsonResponse
    {
        $content = Guarantee::query()
                            ->first()
                            ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function ruleOperation(): JsonResponse
    {
        $content = RuleOperation::query()
                                ->first()
                                ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }

        return response()->json($content);
    }

    public function mobileShopping()
    {
        $content = MobileShoppingContent::query()
                                        ->first()
                                        ->translate(\request()->header('Accept-Language'))
        ;
        $blocks  = MobileShoppingStore::all()
                                      ->translate(\request()->header('Accept-Language'))
        ;
        if ($content->translations->isEmpty()) {
            $content = $content->translate('ru');
        }
        foreach ($blocks as $block) {
            $block->image = env('APP_URL') . '/storage/' . $block->image;
            if ($block->translations->isEmpty()) {
                $block = $block->translate('ru');
            }
        }
        $content->blocks = $blocks;

        return response()->json($content);
    }

    public function shops(): JsonResponse
    {
        $affiliateStore = AffiliateStore::all()
                                        ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($affiliateStore as $item) {
            $item->image = env('APP_URL') . '/storage/' . $item->image;
            if ($item->translations->isEmpty()) {
                $item = $item->translate('ru');
            }
        }
        $storeKazakhstan = StoresKazakhstan::all()
                                           ->translate(\request()->header('Accept-Language'))
        ;
        foreach ($storeKazakhstan as $item) {
            $item->image = env('APP_URL') . '/storage/' . $item->image;
            if ($item->translations->isEmpty()) {
                $item = $item->translate('ru');
            }
        }

        return response()->json([
                                    'affiliateStore'  => $affiliateStore,
                                    'storeKazakhstan' => $storeKazakhstan,
                                ]);

    }
}
