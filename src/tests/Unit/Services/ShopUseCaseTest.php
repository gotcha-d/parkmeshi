<?php

namespace Tests\Unit\Services;

use App\Domain\Entities\Ballpark;
use App\Domain\Entities\Shop;
use App\Domain\Repositories\IBallparkRepository;
use App\Domain\Repositories\IShopRepository;
use App\Services\ShopUseCase;
use Mockery;
use PHPUnit\Framework\TestCase;

class ShopUseCaseTest extends TestCase
{
    /**
     * 店登録処理のテスト（成功）
     *
     * @return void
     */
    public function testCreateShopSucceed()
    {
        // 与えたれた登録情報
        $givenBallparkId = 1;
        $givenShopName = 'test shop';
        $expectedShop = new Shop(1, $givenBallparkId, $givenShopName);
            

        // Mockeryでリポジトリを代用
        $ballparkRepository = Mockery::mock(IBallparkRepository::class);
        $ballparkRepository
            ->shouldReceive('findOrNullById') // 呼ばれる関数
            ->with($givenBallparkId) // 上記関数に渡される引数
            ->andReturn(new Ballpark($givenBallparkId, 'テスト球場')); // 戻り値

        $shopRepository = Mockery::mock(IShopRepository::class);
        $shopRepository
            ->shouldReceive('create')
            ->with(\Hamcrest\Matchers::equalTo(new Shop(null, $givenBallparkId, $givenShopName)))
            ->andReturn($expectedShop)
            ->once();

        // ユースケースには振る舞いを定義したRepositoryを外から注入(DI)
        $shopUseCase = new ShopUseCase($ballparkRepository, $shopRepository);
        $createdShop = $shopUseCase->createShop($givenBallparkId, $givenShopName);
        $this->assertSame($expectedShop, $createdShop);
    }
}
