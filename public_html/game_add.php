<html>
<head>
  <title>追加完了</title>
</head>
<?php

function add_quotations($text) {
  return '"' .$text. '"';
}


function update_overall_result($overall_result, $result) {
  $tmp_list = explode("-", $overall_result);
  $win = intval($tmp_list[0]);
  $lose = intval($tmp_list[1]);
  if ($result == 1) {
    $win++;
  } else if ($result == -1) {
    $lose++;
  } else {
    $win++;
    $lose++;
  }
  $new_overall_result = strval($win) . "-" . strval($lose);

  return $new_overall_result;
}
  


function form_element($element) {
  $element = str_replace('[', '', $element);
  $element = str_replace(']', '', $element);
  $element = explode(" ", $element, 2)[1];
  $element = str_replace('"', '', $element);
  $last_char = substr($element, -1);

  if (ctype_space($last_char)) {
    $element = substr($element, 0, -1);
  }
  return $element;
}


function parse_moves($moves) {
  $moves = preg_replace('/[0-9]+\.\s/', '', $moves);
  $moves = preg_replace('/\s[0-9]+\-[0-9]+/', '', $moves);
  return $moves;
}


function parse_time($time_range) {
  $tmp_list = explode("+", $time_range, 2);
  $base_time = intval($tmp_list[0]);
  $increment = intval($tmp_list[1]);

  #convert base_time to minutes
  $minute = intval($base_time / 60);

  return strval($minute) . "+" . strval($increment);
}


function check_winner($result, $color) {
  if ($result == '1-0') {
    if ($color == 'white') {
      return 1;
    } else {
      return -1;
    }
  } else if ($result == '0-1') {
    if ($color == 'black') {
      return 1;
    } else {
      return -1;
    }
  } else {
    return 0;
  }
}


function parse_pgn($pgn, $color) {
  $splited_data = explode("\n", $pgn);

  $date = form_element($splited_data[2]);
  $white_player = form_element($splited_data[3]);
  $black_player = form_element($splited_data[4]);
  $result = check_winner(form_element($splited_data[5]), $color);
  $time_range = parse_time(form_element($splited_data[13]));
  $opening = form_element($splited_data[15]);
  $moves = parse_moves($splited_data[18]);
  $opponent = '';

  if ($color == 'white') {
    $opponent = $black_player;
  } else {
    $opponent = $white_player;
  }

  return [$date, $result, $time_range, $opening, $moves, $opponent];
}


$host = "localhost";
if (!$conn = mysqli_connect($host, "s2110184", "hogehoge")){
    die("データベース接続エラー.<br />");
}
mysqli_select_db($conn, "s2110184");
mysqli_set_charset($conn, "utf8");

$condition = "";
$color = "";
$tmp_list = "";

if(isset($_POST["color"]) && ($_POST["color"] != "")) {
  $color = ($_POST["color"]);
}

if(isset($_POST["pgn"]) && ($_POST["pgn"] != "")) {
  $pgn = $_POST["pgn"];
}

if ($color != "" && $pgn != "") {
  $tmp_list = parse_pgn($pgn, $color);
} else {
  print("データが不正です");
}

$date = add_quotations($tmp_list[0]);
$result = $tmp_list[1];
$time_range = add_quotations($tmp_list[2]);
$opening = add_quotations($tmp_list[3]);
$moves = add_quotations($tmp_list[4]);
$opponent = add_quotations($tmp_list[5]);
$color = add_quotations($color);
$values = join("," , [$date, $color,  $result, $time_range, $opening, $moves, $opponent]);
$sql = "insert into result (date,  color, gameResult, timeRange, opening, moves, opponentName) values (" .$values. ")";

$res = mysqli_query($conn, $sql);
#$mysqli_free_result($res);

#対戦相手が新しい相手かチェックする
$sql = 'select * from opponent';
$res = mysqli_query($conn, $sql);
$name_list = [];
$is_contain_name = false;
$overall_result = "";

while ($row = mysqli_fetch_array($res)) {
  if (add_quotations($row["name"]) == $opponent) {
    $overall_result = $row["overallResult"];
    $is_contain_name = true;
  }
}


if (!$is_contain_name) {
  #新しくリストに追加
  $overall_result = '';
  if ($result == 'true') {
    $overall_result = '"1-0"';
  } else {
    $overall_result = '"0-1"';
  }
  $values = join(",", [$opponent, $overall_result]);
  $sql = 'insert into opponent (name, overallResult) values (' .$values. ")";
  $res = mysqli_query($conn, $sql);
  #$mysqli_free_result($res);
} else {
  #そうではない場合、結果を書き換える
  $new_overall_result = add_quotations(update_overall_result($overall_result, $result));
  $sql = "update opponent set overallResult=" .$new_overall_result. "where name=" .$opponent;
  $res = mysqli_query($conn, $sql);
}

?>
<p>追加完了しました</p>
<p><a href="result.php">result.php</a>または、<a href="search_form.html">search_form</a>から、確認できます。</p>
<p><a href="index.html">トップに戻る</a></p>
</body>
</html>
