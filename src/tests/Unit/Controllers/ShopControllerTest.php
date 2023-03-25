<?php

namespace Tests\Unit\Controllers;

use App\Domain\Entities\Shop;
use App\Http\Controllers\ShopController;
use App\Models\Ballpark as EloquentBallpark;
use App\Models\Shop as EloquentShop;
use App\Services\ShopUseCase;
use Mockery;
use Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ShopControllerTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        EloquentShop::factory(5)
            ->for(EloquentBallpark::factory()->create())
            ->create();
    }

    /**
     * 店作成が成功することを検証する
     *
     * @return void
     */
    public function testCreateShop200()
    {
        $givenBallparkId = 5;
        $givenShopName = '銀だこ 神宮球場店';
        $wantShopId = 6;

        // mock
        // UseCase
        $mockUseCase = Mockery::mock(ShopUseCase::class);
        $mockUseCase
            ->shouldReceive('createShop')
            ->with($givenBallparkId, $givenShopName)
            ->andReturn(new Shop($wantShopId, $givenBallparkId, $givenShopName));

        // controllerにDIするUseCaseを設定
        $this->app->instance(ShopUseCase::class, $mockUseCase);

        // action
        // controllerの呼び出し
        $response = $this->postJson('/api/shop', [
            'ballparkId' => $givenBallparkId,
            'name' => $givenShopName,
        ]);

        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'id' => $wantShopId,
                'ballparkId' => $givenBallparkId,
                'name' => $givenShopName,
            ]);
    }

    /**
     * 未登録の球場IDが渡された時、404リダイレクトされることを検証する
     * 
     * @return void
     */
    public function testCreateShopPassedNotExistBallPrakIdThen404()
    {
        $givenBallparkId = 6;
        $givenShopName = 'Shop in not exist ballpark';
        $exepectMessage = 'ID:' . $givenBallparkId . 'の球場が見つかりません';

        $mockUseCase = Mockery::mock(ShopUseCase::class);
        $mockUseCase
            ->shouldReceive('createShop')
            ->with($givenBallparkId, $givenShopName)
            ->andThrow(new NotFoundHttpException($exepectMessage));

        $this->app->instance(ShopUseCase::class, $mockUseCase);
        
        $response = $this->postJson('/api/shop', [
            'ballparkId' => $givenBallparkId,
            'name' => $givenShopName
        ]);

        $response->assertNotFound();
        $response->assertJson([
            'message' => $exepectMessage
        ]);

    }
}
