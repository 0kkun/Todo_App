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