<html>
<head><title>配列データの取得</title></head>
<body>
<table border="1">
<tr><td>色</td><td>レンジ</td><td>勝敗</td><td>オープニング</td><td>対戦相手</td><td>詳細</td><td>削除</td></tr>
<?php

function convert_result($result) {
  if ($result == 1) {
    return "勝ち";
  } else if ($result == -1) {
    return "負け";
  } else {
    return "引き分け";
  }
}


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
    print("<td>". convert_result($row["gameResult"])."</td>");
    print("<td>".$row["opening"]."</td>");
    print("<td>".$row["opponentName"]."</td>");
    print("<td><a href= \"game_detail.php?id=".$row["id"]."\">詳細</a></td>");
    print("<td><a href= \"game_delete.php?id=".$row["id"]."\">削除</a></td>");
    print("</tr>\n");
}
mysqli_free_result($res);
?>
</table>
<br><br>
<a href='index.html'>トップに戻る</a>
</body>
</html>
