<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LaravelのEloquentを利用する球場モデル
 */
class Ballpark extends Model
{
    use HasFactory;

    public function shops()
    {  
        // Laravelが自動で子テーブルから ballpark_id　を探して紐づける
        // 外部キーが ballpark_id でない場合はhasManyの第二引数で指定する
        return $this->hasMany(Shop::class);
    }
}
