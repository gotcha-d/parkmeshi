<?php

namespace App\Infrastructure;

use App\Domain\Entities\Shop;
use App\Domain\Repositories\IShopRepository;
use App\Models\Shop as EloquentShop;

/**
 * LaravelのEloquentModelを使ってDB操作を行う、店リポジトリ実装クラス
 * 
 */
class ShopRepository implements IShopRepository
{

    // public function findOrNullById(int $id): ?Shop
    // {
        
    // }
    
    public function create(Shop $shop): Shop
    {
        // DBに保存
        $shopData = EloquentShop::create([
            'ballpark_id' => $shop->ballparkId,
            'name' => $shop->name
        ]);

        // Eloquentのモデルから、ドメインオブジェクトへ詰め替える
        return new Shop(
            $shopData->id,
            $shopData->ballpark_id,
            $shopData->name    
        );
    }
}