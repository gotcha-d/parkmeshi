<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BallparksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ballparks')->insert([
            [
                'name' => 'エスコンフィールドＨＯＫＫＡＩＤＯ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '楽天モバイルパーク宮城',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ベルーナドーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '東京ドーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '明治神宮野球場',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ZOZOマリンスタジアム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '横浜スタジアム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'バンテリンドーム ナゴヤ',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '京セラドーム大阪',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '甲子園',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MAZDA Zoom-Zoom スタジアム広島',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => '福岡PayPayドーム',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
