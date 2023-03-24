<?php

namespace Tests\Unit\Repositories;

use App\Domain\Entities\Ballpark;
use App\Infrastructure\BallparkRepository;
use App\Models\Ballpark as EloquentBallpark;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BallparkRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private BallparkRepository $ballparkRepository;

    public function setUp() :void
    {
        parent::setUp();
        $this->ballparkRepository = new BallparkRepository(new EloquentBallpark());
    }

    /**
     * 指定したIDの球場がDBに存在する時、エンティティに変換されて返すことを検証する
     *
     * @return void
     */
    public function testfindOrNullByIdReturnBallpark() : void
    {
        // register test data
        $expectedBallparkName = 'テスト球場';
        $expectedBallparkdId = EloquentBallpark::factory()->create(['name' => $expectedBallparkName])->id;

        // action
        $foundBallpark = $this->ballparkRepository->findOrNullById($expectedBallparkdId);

        // assert
        $this->assertInstanceOf(Ballpark::class, $foundBallpark);
        $this->assertSame($expectedBallparkName, $foundBallpark->name);
    }
}
