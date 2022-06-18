<?php

function form_element($element) {
  $element = str_replace('[', '', $element);
  $element = str_replace(']', '', $element);
  $element = explode(" ", $element, 2)[1];
  $element = str_replace('"', '', $element);
  return $element;
}


function parse_moves($moves) {
  $moves = preg_replace('/[0-9]+\.\s/', '', $moves);
  $moves = preg_replace('/\s[0-9]+\-[0-9]+/', '', $moves);
  return $moves;
}


function parse_time($time_range) {
  $tmp_list = explode("+", $time_range, 2);
  var_dump($tmp_list);
  $base_time = intval($tmp_list[0]);
  $increment = intval($tmp_list[1]);

  #convert base_time to minutes
  $minute = intval($base_time / 60);

  return strval($minute) . "+" . strval($increment);
}


$filename = 'sample.pgn';
$contents = file_get_contents($filename);

$splited_data = explode("\n", $contents);

$date = form_element($splited_data[2]);
$white_player = form_element($splited_data[3]);
$black_player = form_element($splited_data[4]);
$result = form_element($splited_data[5]);
$time_range = parse_time(form_element($splited_data[13]));
$opening = form_element($splited_data[15]);
$move = parse_moves($splited_data[18]);
?>
