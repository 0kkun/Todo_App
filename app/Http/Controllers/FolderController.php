<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request; // ユーザーの入力値をコントローラーで受け取る為、requestクラスをインポート

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }


    public function create(Request $request) // 引数にインポートしたRequestクラスを受け入れる
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む (永続化)
        $folder->save();

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

}
