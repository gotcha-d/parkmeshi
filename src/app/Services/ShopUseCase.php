<?php

namespace App\Services;

use App\Domain\Entities\Shop;
use App\Domain\Repositories\IBallparkRepository;
use App\Domain\Repositories\IShopRepository;
use App\Exceptions\BallparkNotFoundException;

/**
 * 業務処理を行うクラス
 */
class ShopUseCase
{
    private IBallparkRepository $ballparkRepository;
    private IShopRepository $shopRepository;

    public function __construct(IBallparkRepository $ballparkRepository, IShopRepository $shopRepository)
    {
        $this->ballparkRepository = $ballparkRepository;
        $this->shopRepository = $shopRepository;    
    }

    /**
     * 店を作成する
     * 
     * @param int $ballparkId
     * @param string $name
     * @return Shop
     */
    public function createShop(int $ballparkId, string $name): Shop
    {
        // 球場の存在チェック
        $ballpark = $this->ballparkRepository->findOrNullById($ballparkId);
        if (!$ballpark) {
            throw new BallparkNotFoundException('ID:' . $ballpark . 'の球場が見つかりません');
        }

        // 店作成
        $newShop = new Shop(null, $ballparkId, $name);
        $createdShop = $this->shopRepository->create($newShop);
        return $createdShop;
    }
}