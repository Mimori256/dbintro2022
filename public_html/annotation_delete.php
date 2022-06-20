<html>
<head><title>アノテーションの削除</title></head>
<body>
<?php
$id = strval($_GET['gameid']);
$moveNumber = strval($_GET['moveNumber']);

$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$sql = "DELETE FROM annotation WHERE gameid='$id' and moveNumber='$moveNumber'";
mysqli_query($conn, $sql)
    or die("削除できませんでした");
print("削除しました。<a href=\"annotation.php\">annotation.php</a>で確認してください。");
?>
</body>
</html>
