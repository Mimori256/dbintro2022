<html>
<head><title>アノテーションの追加</title></head>
<body>
<?php
$id = $_GET['gameid'];
$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

#ゲームの棋譜の表示
print("<table border=\"1\">");
print("<tr>棋譜</tr>");
while ($row=mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["moves"]."</td>");
}

print("</tr>");
print("</table>");


?>
<form action="annotation_add.php" method="post">
  <p>ゲームid</p>
  <p><input type="text" name="id" value="<?php echo($id); ?>" /></p>
  <p>ムーブ番号</p>
  <p><input type="text" name="moveNumber"></p>
  <p>アノテーション本文</p>
  <textarea name="message" size="2">
  <br><br>
  <input type="submit" name="submit" value="追加">
</body>
</html>
