<html>
<head><title>配列データの取得</title></head>
<body>
<table border="1">
<tr><td>色</td><td>レンジ</td><td>勝敗</td><td>オープニング</td><td>対戦相手</td></tr>
<?php
$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("MySQL接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM result";
$res = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["color"]."</td>");
    print("<td>".$row["timeRange"]."</td>");
    print("<td>".$row["gameResult"]."</td>");
    print("<td>".$row["opening"]."</td>");
    print("<td>".$row["opponentName"]."</td>");
    print("</tr>\n");
}
mysqli_free_result($res);
?>
</table>
</body>
</html>
