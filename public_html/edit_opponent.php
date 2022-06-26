<html>
<head><title>変更完了</title>
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

$name = add_quotations($_POST['name']);
$misc = add_quotations($_POST['misc']);

$sql = "update opponent set misc = $misc where name = $name";
print($sql);
$res = mysqli_query($conn, $sql);
?>
<p>情報の編集が完了しました</p>
<p><a href="opponent.php">opponent</a>から、変更結果を確認することができます</p>
<br>
<p><a href="index.html">トップに戻る</a></p>
</body>
</html>
