<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LaravelのEloquentを利用する球場モデル
 */
class Shop extends Model
{
    use HasFactory;

    /**
     * 複数代入 レコード追加可能な属性
     */
    protected  $fillable = [
        'ballpark_id',
        'name'
    ];
    
    public function ballpark()
    {
        return $this->belongsTo(Ballpark::class);
    }
}
