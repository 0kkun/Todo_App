<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id) // ビューからリクエスト時の値(URL)を受け取る時は()にいれる
    {
        $folders = Folder::all();

        // view関数でテンプレートに取得したデータを渡す
        // view(テンプレートファイル名, テンプレートに渡すデータ)
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id, // ビューで変数を呼ぶ時は$current_folder_id という名前になる
        ]);
    }
}