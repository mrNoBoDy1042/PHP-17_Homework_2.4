<?php
/* * * * * *
* Скрипт для авторизации пользователя.
* Функции:
* - login - проверяет совпадение логина и пароля с данными
*           уже зарегистрированных пользователей
* - check_post - проверяет метод передачи данных на сервер
* - check_fields - проверяет правильность заполнения полей
* - give_access - присваиваивает пользователю уровень доступа
* * * * * */
session_start();
require_once('Redirect.php');
function login($username, $userpassword)
{
  $users = file_get_contents('users.json');
  $users = json_decode($users, true);
  foreach ($users as $login => $pass) {
    if($username === $login && $userpassword === $pass){
      return true;
    }
    elseif ($username === $login && empty($userpassword)) {
      echo "<script>alert('Такой пользователь уже существует')</script>";
      return $username;
    }
    elseif ($username === $login && $userpassword !== $pass) {
      echo "<script>alert('Неверный пароль')</script>";
    }
  }
  return false;
}

function check_post()
{
  return $_SERVER['REQUEST_METHOD'] == "POST";
}

function check_fields($username,$userpass)
{
  if (check_post()){
    $result = login($username,$userpass);
    if (empty($username)) {
      echo "<script>alert('Необходимо ввсти имя')</script>";
    }
    elseif ($result === true){
      give_access($username, '1');
    }
    elseif (!empty($username) && empty($userpass) && $result !== $username){
      give_access($username, '0');
    }
  }
}

function give_access($username, $status)
{
  $_SESSION['root'] = $status;
  $_SESSION['username'] = $username;
  redirect("list.php");
}
?>
