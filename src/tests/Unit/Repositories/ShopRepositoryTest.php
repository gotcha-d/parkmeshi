<?php

namespace Tests\Unit;

use App\Domain\Entities\Shop;
use App\Infrastructure\ShopRepository;
use App\Models\Ballpark as EloquentBallpark;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use function PHPUnit\Framework\assertSame;

class ShopRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ShopRepository $shopRepository;

    public function setUp() : void
    {
        parent::setUp();
        // 親テーブルとなる球場ダミーデータを作成
        EloquentBallpark::factory(10)->create();
        $this->shopRepository = new ShopRepository();
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:refresh');
        parent::tearDown();
    }

    /**
     * createしたらDBに登録されていることを検証する
     *
     * @return void
     */
    public function testCreateThenSevedInDb() : void
    {
        $newShop = new Shop(null, 10, 'test shop');

        // action
        $createdBook = $this->shopRepository->create($newShop);

        // assert
        // Returned Value
        $this->assertGreaterThan(0, $createdBook->id);
        $this->assertSame(10, $createdBook->ballparkId);
        $this->assertSame('test shop', $createdBook->name);
        // DB
        $this->assertDatabaseHas('shops', [
            'ballpark_id' => 10,
            'name' => 'test shop',
        ]);
    }

    /**
     * DB登録によってIDがインクリメントされていることを検証する
     */
    public function testCreateThenIncrementId() : void
    {
        $firstShop = new Shop(null, 1, 'first');
        $secondShop = new Shop(null, 1, 'sencond');
        $thirdShop = new Shop(null, 1, 'third');

        // action
        $createdBook1 = $this->shopRepository->create($firstShop);
        $createdBook2 = $this->shopRepository->create($secondShop);
        $createdBook3 = $this->shopRepository->create($thirdShop);

        // assert  
        $this->assertSame($createdBook1->id + 1, $createdBook2->id);
        $this->assertSame($createdBook2->id + 1, $createdBook3->id);
    }
}
