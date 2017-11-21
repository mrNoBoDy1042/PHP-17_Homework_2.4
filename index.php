<?php
/* * * * * *
* Стартовая страница.
* Проводит авторизацию пользователей и гостей.
* Функция
* - check_fields - проверяет корректность заполнения полей и выдает уровни доступа
* * * * * */
require_once('login.php');
if(isset($_POST['username'])){
  check_fields($_POST['username'], $_POST['password']);
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
