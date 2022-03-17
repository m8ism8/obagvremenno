<?php

namespace App\Http\Controllers;

use App\Models\AllAboutProduct;
use App\Models\BrandInformation;
use App\Models\CorporateInformation;
use App\Models\GiftRule;
use App\Models\Guarantee;
use App\Models\HistoryMission;
use App\Models\LoyaltySystem;
use App\Models\ProductInformation;
use App\Models\ResearchInnovation;
use App\Models\ReturnInformation;
use App\Models\RuleOperation;
use App\Models\ShippingPayment;
use App\Models\SocialMission;
use Illuminate\Http\JsonResponse;

class InformationPageController extends Controller
{
    public function historyMission(): JsonResponse
    {
        $content = HistoryMission::query()->first();
        return response()->json($content);
    }

    public function socialMission(): JsonResponse
    {
        $content = SocialMission::query()->first();
        return response()->json($content);
    }

    public function brandInformation(): JsonResponse
    {
        $content = BrandInformation::query()->first();
        return response()->json($content);
    }

    public function productInformation(): JsonResponse
    {
        $content = ProductInformation::query()->first();
        return response()->json($content);
    }

    public function allAboutProducts(): JsonResponse
    {
        $content = AllAboutProduct::query()->first();
        return response()->json($content);
    }

    public function researchInnovation(): JsonResponse
    {
        $content = ResearchInnovation::query()->first();
        return response()->json($content);
    }

    public function shippingPayment(): JsonResponse
    {
        $content = ShippingPayment::query()->first();
        return response()->json($content);
    }

    public function returnInformation(): JsonResponse
    {
        $content = ReturnInformation::query()->first();
        return response()->json($content);
    }

    public function loyaltySystem(): JsonResponse
    {
        $content = LoyaltySystem::query()->first();
        return response()->json($content);
    }

    public function corporateInformation(): JsonResponse
    {
        $content = CorporateInformation::query()->first();
        return response()->json($content);
    }

    public function giftRule(): JsonResponse
    {
        $content = GiftRule::query()->first();
        return response()->json($content);
    }

    public function guarantee(): JsonResponse
    {
        $content = Guarantee::query()->first();
        return response()->json($content);
    }

    public function ruleOperation(): JsonResponse
    {
        $content = RuleOperation::query()->first();
        return response()->json($content);
    }
}
