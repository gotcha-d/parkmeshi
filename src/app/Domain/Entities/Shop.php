<?php

namespace App\Domain\Entities;

/**
 * 店クラス
 */
class Shop
{
    public ?int $id;
    public int $ballparkId;
    public string $name;

    public function __construct(?int $id, int $ballparkId, string $name)
    {
        $this->id = $id;
        $this->ballparkId = $ballparkId;
        $this->name = $name;
    }
}