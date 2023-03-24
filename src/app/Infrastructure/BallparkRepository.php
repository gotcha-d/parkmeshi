<?php

namespace App\Infrastructure;

use App\Domain\Entities\Ballpark;
use App\Domain\Repositories\IBallparkRepository;
use App\Models\Ballpark as EloquentBallpark;

/**
 * LaravelのEloquentModelを使ってDB操作を行う、店リポジトリ実装クラス
 * 
 */
class BallparkRepository implements IBallparkRepository
{
    public function findOrNullById(int $id): ?Ballpark
    {
        // LaravelのEloquentモデルを利用して、DBに保存されたデータからインスタンスを取得
        $ballparkData = \App\Models\Ballpark::find($id);
        
        // Eloquentモデルから、ドメインオブジェクトに詰め替える
        if (!$ballparkData) return null;

        return new Ballpark(
            $ballparkData->id,
            $ballparkData->name
        );
    }
}