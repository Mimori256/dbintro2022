<html>
<head>
  <title>追加完了</title>
</head>
<?php

function add_quoations($text) {
  return '"' .$text. '"';
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
    return $color == 'white';
  } else {
    return $color == 'black';
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
  $color = add_quoations($_POST["color"]);
}

if(isset($_POST["pgn"]) && ($_POST["pgn"] != "")) {
  $pgn = $_POST["pgn"];
}

if ($color != "" && $pgn != "") {
  $tmp_list = parse_pgn($pgn, $color);
} else {
  print("データが不正です");
}

$date = add_quoations($tmp_list[0]);
$result = $tmp_list[1];
$time_range = add_quoations($tmp_list[2]);
$opening = add_quoations($tmp_list[3]);
$moves = add_quoations($tmp_list[4]);
$opponent = add_quoations($tmp_list[5]);
$values = join("," , [$date, $color, $result, $time_range, $opening, $moves, $opponent]);

$sql = "insert into result (date,  color, gameResult, timeRange, opening, moves, opponent) values (" .$values. ")";
print($sql);
print("\n");

$res = mysqli_query($conn, $sql);
$mysqli_free_result($res);

print($res);

?>

</body>
</html>
