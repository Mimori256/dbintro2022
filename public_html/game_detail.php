<html>
<head><title>ゲーム詳細</title></head>
<body>
<?php

$id = $_GET['id'];

$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$sql = "select * from result  WHERE id=$id";
$res = mysqli_query($conn, $sql);

print("<table border=\"1\">");
print("<tr><td>ID</td><td>日付</td><td>色</td><td>タイムレンジ</td><td>結果</td><td>オープニング</td></tr>");
while ($row=mysqli_fetch_array($res)) {
  print("<tr>");
  print("<td>".$row["id"]."</td>");
  print("<td>".$row["date"]."</td>");
  print("<td>".$row["color"]."</td>");
  print("<td>".$row["timeRange"]."</td>");
  print("<td>".$row["gameResult"]."</td>");
  print("<td>".$row["opening"]."</td>");
}
print("</tr>");
print("</table>");
print("<br><br>");
#棋譜の表示
$sql = "select * from result where id=" .$id;
$res = mysqli_query($conn, $sql);

print("<table border=\"1\">");
print("<tr>棋譜</tr>");
while ($row=mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["moves"]."</td>");
}

print("</tr>");
print("</table>");
print("<br><br>");

#アノテーションの表示
$sql= "select * from annotation where gameid=" .$id. " order by moveNumber";
print("<table border=\"1\">");
print("<tr><td>ムーブ番号</td><td>アノテーション</td></tr>");

$res = mysqli_query($conn, $sql);

while ($row=mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["moveNumber"]."</td>");
    print("<td>".$row["message"]."</td>");
}

print("</tr>");
print("</table>");

#アノテーション追加用のリンクを貼る
$link_tag = "<p><a href= annotation_add_form.php?gameid=$id>アノテーションの追加</a></p>";
print("<p>アノテーションを追加するには、下のリンクをクリックしてください</p>");
print($link_tag);
 
?>
</body>
</html>
