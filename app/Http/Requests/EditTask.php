<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

// EditTask クラスは CreateTask クラスを継承
// タスクの作成と編集では状態欄の有無が異なるだけでタイトルと期限日は同一なので重複を避けるために継承
class EditTask extends CreateTask
{

    public function rules()
    {
        $rule = parent::rules();

        // 入力値が許可リストに含まれているか検証する in ルールを使用。1~3のどれかになっているか？
        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
            'status' => 'required|' . $status_rule,
        ];
    }

    // 親クラス CreateTask の rules メソッドの結果と合体したルールリストを返却
    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }


    // Task::STATUS から status.in ルールのメッセージを作成
    // Task::STATUS の各要素から label キーの値のみ取り出して作った配列をさらに句読点でくっつけて文字列を作成
    // 最終的に「状態 には 未着手、着手中、完了 のいずれかを指定してください。」というメッセージが出来る
    public function messages()
    {
        $messages = parent::messages();

        $status_labels = array_map(function($item) {
            return $item['label'];
        }, Task::STATUS);

        $status_labels = implode('、', $status_labels);

        return $messages + [
            'status.in' => ':attribute には ' . $status_labels. ' のいずれかを指定してください。',
        ];
    }
}
