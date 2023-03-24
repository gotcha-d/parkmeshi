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
    private EloquentBallpark $eloquentBallpark;

    public function __construct(EloquentBallpark $eloquentBallpark)
    {
        $this->eloquentBallpark = $eloquentBallpark;
    }

    public function findOrNullById(int $id): ?Ballpark
    {
        $ballparkData = $this->eloquentBallpark->find($id);
        
        // Eloquentのモデルから、ドメインオブジェクトに詰め替える
        if (!$ballparkData) return null;

        return new Ballpark(
            $ballparkData->id,
            $ballparkData->name
        );
    }
}