<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
  <nav class="my-navbar">
    <a class="my-navbar-brand" href="/">ToDo App</a>
  </nav>
</header>
<main>
  <div class="container">
    <div class="row">
      <div class="col col-md-4">
        <nav class="panel panel-default">
          <div class="panel-heading">フォルダ</div>
          <div class="panel-body">
            <a href="#" class="btn btn-default btn-block">
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
        <!-- ここにタスクが表示される -->
      </div>
    </div>
  </div>
</main>
</body>
</html>