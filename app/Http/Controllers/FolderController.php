<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request; // ユーザーの入力値をコントローラーで受け取る為、requestクラスをインポート
use App\Http\Requests\CreateFolder; // バリデーションを有効にする為にインポート
use Illuminate\Support\Facades\Auth; 

class FolderController extends Controller
{
    public function showCreateForm()
    {
        return view('folders/create');
    }


    public function create(CreateFolder $request) // 引数にインポートしたRequestクラスを受け入れる。バリデーション有効になる。
    {
        // フォルダモデルのインスタンスを作成する
        $folder = new Folder();
        // タイトルに入力値を代入する
        $folder->title = $request->title;
        // インスタンスの状態をデータベースに書き込む (永続化)
        // ユーザーに紐づいてフォルダが保存される
        Auth::user()->folders()->save($folder);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

}
