<?php
require_once('login.php');
if(isset($_POST['username'])){
  CheckFields($_POST['username'], $_POST['password']);
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Авторизация</title>
  </head>
  <body>
    <form method="post">
      <label>Ваше имя: <input type="text" name="username"></label><br><br>
      <label>Пароль:<input type="password" name="password"></label><br><br>
      <input type="submit" value="Login">
    </form>
  </body>
</html>
