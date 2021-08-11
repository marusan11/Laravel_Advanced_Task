<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['user_id','url','comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
        // 「MovieモデルがUserモデルに所属している」
    }
}

// fillable変数を定義することで３つのカラム（'user_id','url','comment'）を一度に入力→保存できる