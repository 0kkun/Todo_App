<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> <!-- flatpickrを使用するためのファイル（デフォルトのスタイルシート ）-->
  <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css"> <!-- flatpickrを使用するためのファイル（ブルーテーマの追加スタイルシート）-->
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
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクを追加する</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
              </div>
              <div class="form-group">
                <label for="due_date">期限</label>
                <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
</main>

<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script> <!-- flatpickrを使用するためのファイル （flatpickrスクリプト ）-->
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script> <!-- flatpickrを使用するためのファイル  （日本語化のための追加スクリプト）-->
<script>
  // 第一引数に flatpickr で日付選択を行わせたい要素を指定し、第二引数にオプションを指定
  flatpickr(document.getElementById('due_date'), {
    locale: 'ja', // 曜日を月火水…と日本語表記するため
    dateFormat: "Y/m/d", // 日付表記のフォーマット
    minDate: new Date() // 本日日付よろ若い日付（過去）を入力できないようにオプション
  });
</script>
</body>
</html>