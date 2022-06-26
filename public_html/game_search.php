<html>
<head><title>検索結果</title></head>
<body>
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
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$condition = "";

if(isset($_POST["gameid"]) && ($_POST["gameid"] != "")){
  $id = mysqli_escape_string($conn, $_POST["gameid"]);
  $id = str_replace("%", "\%", $id);
  $id = "WHERE id = $id";
}

if(isset($_POST["color"]) && ($_POST["color"] != "")){
  $color = mysqli_escape_string($conn, $_POST["color"]);
  $auth = str_replace("%", "\%", $auth);
  if ($condition == ""){
      $condition = "WHERE color LIKE \"%".$color."%\"";
  } else{
      $condition .= "AND color LIKE \"%".$color."%\"";
  }
}

if(isset($_POST["timeRange"]) && ($_POST["timeRange"] != "")){
  $timeRange = mysqli_escape_string($conn, $_POST["timeRange"]);
  $auth = str_replace("%", "\%", $auth);
  if ($condition == ""){
    $condition = "WHERE timeRange LIKE \"%".$timeRange."%\"";
  } else {
    $condition .= "AND timeRange LIKE \"%".$timeRange."%\"";
  }
}

if(isset($_POST["gameResult"]) && ($_POST["gameResult"] != "")){
  $gameResult = mysqli_escape_string($conn, $_POST["gameResult"]);
  $winOrLose = true;
    
  if ($gameResult == "win"){
    $winOrLose = 1;
  } else if ($gameResult == "lose") {
    $winOrLose = -1;
  } else {
    //draw
    $winOrLose = 0;
  }

  $auth = str_replace("%", "\%", $auth);
  if ($condition == ""){
    $condition = "WHERE gameResult=$winOrLose";
  } else {
    $condition .= "AND gameResult=$winOrLose";
  }
}


if(isset($_POST["opening"]) && ($_POST["opening"] != "")){
   $opening = mysqli_escape_string($conn, $_POST["opening"]);
   $auth = str_replace("%", "\%", $auth);
   if ($condition == ""){
       $condition = "WHERE opening LIKE \"%".$opening."%\"";
   } else{
       $condition .= "AND opening LIKE \"%".$opening."%\"";
   }
}

if(isset($_POST["opponentName"]) && ($_POST["opponentName"] != "")){
  $opponentName = mysqli_escape_string($conn, $_POST["opponentName"]);
  $auth = str_replace("%", "\%", $auth);
  if ($condition == ""){
      $condition = "WHERE opponentName LIKE \"%".$opponentName."%\"";
  } else{
      $condition .= "AND opponentName LIKE \"%".$opponentName."%\"";
  }
}

if(isset($_POST["containAnnotation"]) && ($_POST["containAnnotation"] != "")) {
  $containAnnotation = $_POST["containAnnotation"];
  $is_contain_annotaion = false;
  if ($containAnnotation == "yes") {
    $is_contain_annotaion = true;
  } else {
    $is_contain_annotaion = false;
  }

  if ($condition == "" and $is_contain_annotaion) {
    $condition = "WHERE result.id = annotation.gameid";
  } else if($condition != "" and $is_contain_annotaion) {
    $condition .= 'AND result.id = annotation.gameid';
  }
}

$sql = "SELECT * FROM result, annotation ".$condition." ORDER BY id";
$res = mysqli_query($conn, $sql);
print("<table border=\"1\">");
print("<tr><td>ID</td><td>日付</td><td>色</td><td>タイムレンジ</td><td>結果</td><td>オープニング</td><td>対戦相手</td><td>詳細</td><td>削除</td></tr>");
while($row = mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["id"]."</td>");
    print("<td>".$row["date"]."</td>");
    print("<td>".$row["color"]."</td>");
    print("<td>".$row["timeRange"]."</td>");
    print("<td>". convert_result($row["gameResult"])."</td>");
    print("<td>".$row["opening"]."</td>");
    print("<td>".$row["opponentName"]."</td>");
    print("<td><a href= \"game_detail.php?id=".$row["id"]."\">詳細</a></td>");
    print("<td><a href= \"game_delete.php?id=".$row["id"]."\">削除</a></td>");
    print("</tr>");
}
print("</table>");
mysqli_free_result($res);
?>
</body>
</html>
