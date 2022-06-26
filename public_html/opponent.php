<html>
<head><title>配列データの取得</title></head>
<body>
<table border="1">
<tr><td>対戦相手の名前</td><td>今までの勝敗</td><td>備考</td><td>備考の編集</td></tr>
<?php
$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("MySQL接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");
$sql = "SELECT * FROM opponent  LIMIT 10";
$res = mysqli_query($conn, $sql);
$edit_link = "";
$name = "";
while($row = mysqli_fetch_array($res)) {
  $name = $row["name"];
  $edit_link = "<td><a href = edit_opponent_form.php?name=$name>編集</a></td>";
  print("<tr>");
  print("<td>".$row["name"]."</td>");
  print("<td>".$row["overallResult"]."</td>");
  print("<td>".$row["misc"]."</td>");
  print($edit_link);
  print("</tr>\n");
}
mysqli_free_result($res);
?>
</table>
</body>
</html>
