<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTask extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'title' => 'required|max:100',
        'due_date' => 'required|date|after_or_equal:today',
        ];
    }


    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'due_date' => '期限日',
        ];
    }


    //messageメソッドは FormRequest クラス単位でエラーメッセージを出力することができる
    // validation.php ではなく messages メソッドを使用した理由は、todayをうまく「今日」などの日本語にできないから。
    public function messages()
    {
        return [
            // キーでメッセージが表示されるべきルールを指定する。
            // ドット区切りで左側が項目、右側がルールを意味する。
            // due_date の after_or_equal ルールに違反した場合は、値に指定されたメッセージを出力する
            'due_date.after_or_equal' => ':attribute には今日以降の日付を入力してください。',
        ];
    }
}
