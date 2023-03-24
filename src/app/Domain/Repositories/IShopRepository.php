<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Shop;

/**
 * 店クラスのリポジトリインターフェース
 */
Interface IShopRepository
{
    /**
     * idから1件取得またはNULLを返す
     *  
     * @param int $id
     * @return Shop|null
     */
    // public function findOrNullById(int $id): ?Shop;

    /**
     * 店を新規登録する
     * 
     * @param Shop $shop 新規登録する店
     * @return Shop 新規登録された店
     */
    public function create(Shop $shop): Shop;
}