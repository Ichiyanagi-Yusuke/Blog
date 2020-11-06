<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //テーブル名
    protected $table = 'blogs';

    //変更可能カラム
    protected $fillable =
    [
      'title',
      'content'
    ];
}
