<html>
<head><title>追加完了</title>
</head>
<body>
<?php

function add_quotations($text) {
  return '"' .$text. '"';
}

$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$id = $_POST['gameid'];
$moveNumber = $_POST['moveNumber'];
$message = add_quotations($_POST['message']);
$values = join(',', [$id, $moveNumber, $message]);
$back_link = "<a href= \"game_detail.php?id=$id\">ゲーム詳細に戻る</a>";

#値が入力されているなら
if ($moveNumber != '' && $message != '') {
  $sql = "insert into annotation values (" .$values. ")";
  $res = mysqli_query($conn, $sql);
  print("<p>アノテーションの挿入が完了しました</p>");
  print("<p>下のリンクをクリックして、ゲーム詳細に戻ってください</p>");
} else {
  print("エラーが発生しました。正しく値を入力してください");
}

?>
</body>
</html>
