<?php

namespace App\Http\Controllers;

use App\Exceptions\BallparkNotFoundException;
use App\Services\ShopUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    private ShopUseCase $shopUseCase;

    public function __construct(ShopUseCase $shopUseCase)
    {
        $this->shopUseCase = $shopUseCase;
    }

    /**
     * 店を作成する
     * 
     * @param　Request $request
     * @return JsonResponse
     */
    public function createShop(Request $request) : JsonResponse
    {
        $ballparkId = $request->input('ballparkId');
        $shopName = $request->input('name');

        try {
            $createdShop = $this->shopUseCase->createShop($ballparkId, $shopName);
        } catch(BallparkNotFoundException $e) {
            // abort(404, $e->getMessage());
            // abortはLaravelのヘルパー関数
            abort(
                response()->json(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND)
            );
        }

        return response()
            ->json($createdShop)
            ->setStatusCode(Response::HTTP_OK);
    }
}
