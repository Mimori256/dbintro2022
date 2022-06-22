<html>
<head><title>アノテーションの追加</title></head>
<body>
<?php

function add_color_tag($element) {
  return "<font color='lightblue'>$element</font>";
}


function add_index($moves) {
  $splited_move = explode(" ", $moves);
  $length = count($splited_move);
  $move_index = '';
  $first_char = '';

  for ($i = 0; $i < $length; $i++) {
    $first_char = substr($splited_move[$i], 0, 1);
    if ($first_char != '0' && $first_char != '1') {
      $move_index = add_color_tag(strval($i+1) . '. ');
      $splited_move[$i] = $move_index . $splited_move[$i];
    }
  }

  return join(" ", $splited_move); 
 }


$id = $_GET['gameid'];
$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$sql = "select * from result where id=$id";
$res =  mysqli_query($conn, $sql);

#ゲームの棋譜の表示
print("<table border=\"1\">");
print("<tr>棋譜</tr>");
while ($row=mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".add_index($row["moves"])."</td>");
}

print("</tr>");
print("</table>");


?>
<form action="annotation_add.php" method="post">
  <p>ゲームid(変更不可)</p>
  <p><input type="text" name="gameid" readonly="readonly"  value="<?php echo($id); ?>" /></p>
  <p>ムーブ番号</p>
  <p><input type="text" name="moveNumber"></input></p>
  <p>アノテーション本文</p>
  <textarea name="message" size="2"></textarea>
  <br><br>
  <input type="submit" name="submit" value="追加">
</body>
</html>
