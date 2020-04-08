<?php

namespace App\Http\Controllers;

use App\Folder; // モデルを読み込んで、データベースとやり取りできるようになる
use App\Task;   // モデルを読み込み
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask; // バリデーションを有効にする為にインポート

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
        // $tasks = Task::where('folder_id', '=', $current_folder->id)->get();
        // 最終的に、モデルにリレーションを記述することで下記のように書ける
        $tasks = $current_folder->tasks()->get();
 

        // view関数でテンプレートに取得したデータを渡す
        // view(テンプレートファイル名, テンプレートに渡すデータ)
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $id, // ビューで変数を呼ぶ時は$current_folder_id という名前になる
            'tasks' => $tasks,
        ]);
    }


    // GET /folders/{id}/tasks/create
    // form要素のaction属性としてタスク作成
    // URL（/folders/{id}/tasks/create）を作るためにフォルダの ID が必要なので、コントローラーメソッドの引数で受け取って view 関数でテンプレートに渡す
    public function showCreateForm(int $id)
    {
        return view('tasks/create', [
            'folder_id' => $id
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        $current_folder = Folder::find($id);
    
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
    
        // リレーションを活かしたデータの保存方法。$current_folderに紐づくタスクを作成
        $current_folder->tasks()->save($task);
    
        return redirect()->route('tasks.index', [
            'id' => $current_folder->id,
        ]);
    }

}