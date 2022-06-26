<html>
<head><title>対戦相手の備考の編集</title></head>
<body>

<?php
$name = $_GET['name'];
print("対戦相手の名前: $name");
?>
<form action="edit_opponent.php" method="post">
  <p>名前(変更不可</p>
  <p><input type="text" name="name" readonly="readonly" value="<?php echo($name); ?>" /></p>
  <textarea name="misc" size="2"></textarea>
  <br><br>
  <input type="submit" name="submit" value="編集">
</body>
</html>
