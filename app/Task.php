<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; //位置に注意！

class Task extends Model
{
    const STATUS = [
        1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
        2 => [ 'label' => '着手中', 'class' => 'label-info' ],
        3 => [ 'label' => '完了', 'class' => '' ],
    ];

    /**
     * 状態を表すHTMLクラス
     * @return string
     */
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

        return self::STATUS[$status]['class'];
    }

    /**
     * 整形した期限日
     * @return string
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
            ->format('Y/m/d');
    }
}
