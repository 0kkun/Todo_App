<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    // リレーションを設定。これを設定することで、コントローラでフォルダに紐づくタスクデータを呼び出す時に
    // $tasks = $current_folder->tasks()->get();とするだけで呼び出せる。
    // 本来なら$tasks = Tasks::where('folder_id', $current_folder->id)->get();と記述する
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
