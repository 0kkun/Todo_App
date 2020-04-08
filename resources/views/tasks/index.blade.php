@extends('layout')



@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">

            <a href="{{ route('folders.create') }}" class="btn btn-default btn-block">
              フォルダを追加する
            </a>

          </div>
          <div class="list-group">
            <!-- テンプレートの中でのphpは@をつけるのがルール -->
            <!-- 変数の値の展開は、 のように波括弧二つで実現 -->
            <!-- コントローラから渡された$foldersのデータを$folderという変数で展開している -->
            <!-- route 関数はルーティングの設定からURLを作り出す関数。route ルート名,URLの変数になっている部分-->
            <!-- 閲覧されているフォルダの ID と ID 値が合致する場合のみ 'active' という HTML クラスを出力。青色にする -->
            @foreach($folders as $folder)
              <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" 
                class="list-group-item {{ $current_folder_id === $folder->id ? 'active' : '' }}">

                {{ $folder->title }}

              </a>
              
            @endforeach
          </div>
        </nav>
      </div>
      <div class="column col-md-8">
        <!--------- ここにタスクが表示される ------>
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
              <a href="{{ route('tasks.create', ['id' => $current_folder_id]) }}" class="btn btn-default btn-block">
                タスクを追加する
              </a>
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              <!-- コントローラーから渡されたtasksをループして一つ一つのタスクデータを出力 -->
              @foreach($tasks as $task)
                <tr>
                  <td>{{ $task->title }}</td>
                  <td>
                    <!-- status_classとstatus_labelはモデルでアクセサを使って定義している -->
                    <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                  </td>
                  <td>{{ $task->formatted_due_date }}</td>
                  <td><a href="#">編集</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!---------------------------------->

      </div>
    </div>
  </div>
@endsection