<?php

namespace App\Http\Controllers;

use App\Folder; // モデルを読み込んで、データベースとやり取りできるようになる
use App\Task;   // モデルを読み込み
use Illuminate\Http\Request;
use App\Http\Requests\CreateTask; // バリデーションを有効にする為にインポート
use App\Http\Requests\EditTask;
use Illuminate\Support\Facades\Auth; 

class TaskController extends Controller
{
    public function index(Folder $folder) // ビューからリクエスト時の値(URL)を受け取る時は()にいれる
    {
        // ★ ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダに紐づくタスクを取得する
        // where(カラム名, 比較式, 値)
        // GETメソッドで構築されたSQLをデータベースに発行して結果を取得
        // SQLで下記の式をかくと、select * from `tasks` where `folder_id` = ?
        // 右記のように省略もできる。$tasks = Task::where('folder_id', $current_folder->id)->get();
        // $tasks = Task::where('folder_id', '=', $current_folder->id)->get();
        // 最終的に、モデルにリレーションを記述することで下記のように書ける
        // $tasks = $current_folder->tasks()->get();
        // Laravel は、ルーティング定義の URL の中括弧で囲まれたキーワード（{folder}）とコントローラーメソッドの仮引数名（$folder）が一致していて、
        // かつ引数が型指定（Folder）されていれば、URL の中括弧で囲まれた部分の値を ID とみなす！
        $tasks = $folder->tasks()->get();
 

        // view関数でテンプレートに取得したデータを渡す
        // view(テンプレートファイル名, テンプレートに渡すデータ)
        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,// ビューで変数を呼ぶ時は$current_folder_id という名前になる
            'tasks' => $tasks,
        ]);
    }


    // GET /folders/{id}/tasks/create
    // form要素のaction属性としてタスク作成
    // URL（/folders/{id}/tasks/create）を作るためにフォルダの ID が必要なので、コントローラーメソッドの引数で受け取って view 関数でテンプレートに渡す
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
    
        // リレーションを活かしたデータの保存方法。$current_folderに紐づくタスクを作成
        $folder->tasks()->save($task);
    
        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }


    // GET /folders/{id}/tasks/{task_id}/edit
    public function showEditForm(Folder $folder, Task $task)
    {

        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }
    

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        // 2 編集対象のタスクデータに入力値を詰めて save
        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        // 3 最後に編集対象のタスクが属するタスク一覧画面へリダイレクト
        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    // エラーハンドリング用のメソッド
    // フォルダが存在してそのフォルダとログインユーザーが紐づいてさえいれば
    // タスク ID が他者のものでも編集できてしまう。これを阻止するため
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }
}