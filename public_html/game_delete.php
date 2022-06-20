<html>
<head><title>ゲームの削除</title></head>
<body>
<?php
$id = $_GET['id'];

$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$sql = "DELETE FROM result WHERE id='$id'";
mysqli_query($conn, $sql)
    or die("削除できませんでした");
print("削除しました。<a href=\"search_form.html\">search_form.html</a>で確認してください。");
?>
</body>
</html>
