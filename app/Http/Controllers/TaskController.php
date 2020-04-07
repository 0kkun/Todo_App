<?php

namespace App\Http\Controllers;

use App\Folder; // モデルを読み込んで、データベースとやり取りできるようになる
use App\Task;   // モデルを読み込み
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(int $id) // ビューからリクエスト時の値(URL)を受け取る時は()にいれる
    {
        // すべてのフォルダを取得する
        $folders = Folder::all();
    
        // 選ばれたフォルダを取得する
        $current_folder = Folder::find($id);

        // 選ばれたフォルダに紐づくタスクを取得する
        // where(カラム名, 比較式, 値)
        // getメソッドで構築されたSQLをデータベースに発行して結果を取得
        // SQLで下記の式をかくと、select * from `tasks` where `folder_id` = ?
        // 右記のように省略もできる。$tasks = Task::where('folder_id', $current_folder->id)->get();
        $tasks = Task::where('folder_id', '=', $current_folder->id)->get();
 

        // view関数でテンプレートに取得したデータを渡す
        // view(テンプレートファイル名, テンプレートに渡すデータ)
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id, // ビューで変数を呼ぶ時は$current_folder_id という名前になる
            'tasks' => $tasks,
        ]);
    }
}