<html>
<head><title>検索結果</title></head>
<body>
<?php
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
    } else{
        $condition .= "AND timeRange LIKE \"%".$timeRange."%\"";
    }
}

if(isset($_POST["gameResult"]) && ($_POST["gameResult"] != "")){
    $gameResult = mysqli_escape_string($conn, $_POST["gameResult"]);
    $winOrLose = true;
    
    if ($gameResult == "win"){
      $winOrLose = true;
    } else {
      $winOrLose = false;
    }

    $auth = str_replace("%", "\%", $auth);
    print($gameResult);
    if ($condition == ""){
        $condition = "WHERE gameResult=$winOrLose";
    } else{
        $condition .= "AND gameResult=$winOrLose";
    }
}

/*
if(isset($_POST["opening"]) && ($_POST["opening"] != "")){
    $gameResult = mysqli_escape_string($conn, $_POST["opening"]);
    $auth = str_replace("%", "\%", $auth);
    if ($condition == ""){
        $condition = "WHERE color LIKE \"%".$opening."%\"";
    } else{
        $condition .= "AND color LIKE \"%".$opening."%\"";
    }
}

if(isset($_POST["opponentName"]) && ($_POST["opponentName" != "")){
    $gameResult = mysqli_escape_string($conn, $_POST["opponentName"]);
    $auth = str_replace("%", "\%", $auth);
    if ($condition == ""){
        $condition = "WHERE color LIKE \"%".$opponentName."%\"";
    } else{
        $condition .= "AND color LIKE \"%".$opponentName."%\"";
    }
}
*/

$sql = "SELECT * FROM result ".$condition." ORDER BY id";
print($sql);
$res = mysqli_query($conn, $sql);
print("<table border=\"1\">");
print("<tr><td>ID</td><td>日付</td><td>色</td><td>タイムレンジ</td><td>結果</td><td>オープニング</td><td>対戦相手</td><td>詳細</td><td>削除</td></tr>");
while($row = mysqli_fetch_array($res)) {
    print("<tr>");
    print("<td>".$row["id"]."</td>");
    print("<td>".$row["date"]."</td>");
    print("<td>".$row["color"]."</td>");
    print("<td>".$row["timeRange"]."</td>");
    print("<td>".$row["gameResult"]."</td>");
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
