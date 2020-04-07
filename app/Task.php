<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const STATUS = [
        1 => [ 'label' => '未着手' ],
        2 => [ 'label' => '着手中' ],
        3 => [ 'label' => '完了' ],
    ];

    // アクセサを使ってstatusの値によってstatusのテキストを定義する
    // アクセサとはモデルクラスが本来持つデータを加工した値を、さもモデルクラスのプロパティであるかのように参照できる Laravel の機能
    public function getStatusLabelAttribute()
    {
        // statusカラムの値を取得
        $status = $this->attributes['status'];

        // 定義されていなければ空文字を返す
        if (!isset(self::STATUS[$status])) {
            return '';
        }

        return self::STATUS[$status]['label'];
    }
}
