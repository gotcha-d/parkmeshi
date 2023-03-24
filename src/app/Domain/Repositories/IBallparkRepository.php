<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Ballpark;

/**
 * 球場クラスのリポジトリインターフェース
 */
Interface IBallparkRepository
{
    /**
     * idから1件取得またはNULLを返す
     * 
     * @param int $id
     * @return Ballpark|null
     */
    public function findOrNullById(int $id): ?Ballpark;
}