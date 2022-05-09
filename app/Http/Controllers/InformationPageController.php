<?php

namespace App\Http\Controllers;

use App\Models\AffiliateStore;
use App\Models\AllAboutProduct;
use App\Models\BrandInformation;
use App\Models\CorporateInformation;
use App\Models\GiftRule;
use App\Models\Guarantee;
use App\Models\HistoryMission;
use App\Models\LoyaltySystem;
use App\Models\MobileShoppingContent;
use App\Models\MobileShoppingStore;
use App\Models\ProductInformation;
use App\Models\ResearchInnovation;
use App\Models\ReturnInformation;
use App\Models\RuleOperation;
use App\Models\Seo;
use App\Models\ShippingPayment;
use App\Models\SocialMission;
use App\Models\StoresKazakhstan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InformationPageController extends Controller
{
    public function seo(string $seo)
    {
        $seo = Seo::query()
                  ->where('slug', $seo)
                  ->select('slug', 'title', 'hid', 'name', 'content')
                  ->first()
        ;
        if ($seo == null) {
            return response()->json([
                                        'message' => 'Не найдено',
                                    ], 404);
        }
        $title = $seo->title;
        unset($seo->title);
        unset($seo->slug);

        return response()->json([
                                    'title' => $title,
                                    'meta' => [
                                        $seo
                                    ],
                                ]);
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

    public function historyMission(): JsonResponse
    {
        $content = HistoryMission::query()
                                 ->first()
        ;

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
        ;

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
        ;

        return response()->json($content);
    }

    public function productInformation(): JsonResponse
    {
        $content        = ProductInformation::query()
                                            ->first()
        ;
        $content->image = env('APP_URL') . '/storage/' . $content->image;

        return response()->json($content);
    }

    public function allAboutProducts(): JsonResponse
    {
        $content        = AllAboutProduct::query()
                                         ->first()
        ;
        $content->image = env('APP_URL') . '/storage/' . $content->image;

        return response()->json($content);
    }

    public function researchInnovation(): JsonResponse
    {
        $content = ResearchInnovation::query()
                                     ->first()
        ;

        return response()->json($content);
    }

    public function shippingPayment(): JsonResponse
    {
        $content = ShippingPayment::query()
                                  ->first()
        ;
        $images  = json_decode($content->images, true);
        $img     = [];
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
        ;

        return response()->json($content);
    }

    public function loyaltySystem(): JsonResponse
    {
        //TODO сделать блоки
        $content = LoyaltySystem::query()
                                ->first()
        ;

        return response()->json($content);
    }

    public function corporateInformation(): JsonResponse
    {
        //TODO сделать блоки
        $content = CorporateInformation::query()
                                       ->first()
        ;

        return response()->json($content);
    }

    public function giftRule(): JsonResponse
    {
        $content        = GiftRule::query()
                                  ->first()
        ;
        $content->image = env('APP_URL') . '/storage/' . $content->image;

        return response()->json($content);
    }

    public function guarantee(): JsonResponse
    {
        $content = Guarantee::query()
                            ->first()
        ;

        return response()->json($content);
    }

    public function ruleOperation(): JsonResponse
    {
        $content = RuleOperation::query()
                                ->first()
        ;

        return response()->json($content);
    }

    public function mobileShopping(): JsonResponse
    {
        $content = MobileShoppingContent::query()
                                        ->first()
        ;
        $blocks  = MobileShoppingStore::all();

        foreach ($blocks as $block) {
            $block->image = env('APP_URL') . '/storage/' . $block->image;
        }
        $content->blocks = $blocks;

        return response()->json($content);
    }

    public function shops(): JsonResponse
    {
        $affiliateStore = AffiliateStore::all();
        foreach ($affiliateStore as $item) {
            $item->image = env('APP_URL') . '/storage/' . $item->image;
        }
        $storeKazakhstan = StoresKazakhstan::all();
        foreach ($storeKazakhstan as $item) {
            $item->image = env('APP_URL') . '/storage/' . $item->image;
        }

        return response()->json([
                                    'affiliateStore'  => $affiliateStore,
                                    'storeKazakhstan' => $storeKazakhstan,
                                ]);

    }
}
