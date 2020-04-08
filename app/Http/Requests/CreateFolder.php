<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// バリデーション設定
// FormRequest クラスは基本的に一つのリクエストに対して一つ作成
class CreateFolder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    // authorize メソッドはリクエストの内容に基づいた権限チェックのために使う。
    // 今回はこの機能は使用しないので true を返す（つまりリクエストを受け付ける）
    public function authorize()
    {
        return true;    //★
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    // 入力欄ごとにチェックするルールを定義
    public function rules()
    {
        return [
            'title' => 'required', // 必須入力を意味する required を指定
            'title' => 'required|max:20',
        ];
    }


    public function attributes()
    {
        return [
            'title' => 'フォルダ名',
        ];
    }
}
