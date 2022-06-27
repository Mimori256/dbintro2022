<html>
<head><title>配列データの取得</title></head>
<body>
<p>ここで登録されたアノテーション一覧を見ることができます。また、アノテーションの削除もできます。</p>
<table border="1">
<tr><td>gameID</td><td>ムーブ番号</td><td>アノテーション</td><td>削除</td></tr>
<?php
$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("MySQL接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM annotation order by gameid";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["gameid"]."</td>");
    print("<td>".$row["moveNumber"]."</td>");
    print("<td>".$row["message"]."</td>");
    print("<td><a href= \"annotation_delete.php?gameid=" .strval($row["gameid"])."&moveNumber=" .strval($row["moveNumber"]). "\">削除</a></td>");
    print("</tr>\n");
}
mysqli_free_result($res);
?>
</table>
<br><br>
<a href='index.html'>トップに戻る</a>
</body>
</html>
