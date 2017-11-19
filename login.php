<?php
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
  }
  return false;
}

function CheckPost()
{
  return $_SERVER['REQUEST_METHOD'] == "POST";
}

function CheckFields($username,$userpass)
{
  if (CheckPost()){
    if (!empty($userpass)){
      if (login($username,$userpass)){
        GiveAccess($username, '1');
      }
      else{
        echo "<script>alert('Неверный логин и пароль')</script>";
      }
    }
    else{
      if(!empty($username)){
        GiveAccess($username, '0');
      }
      else{
        echo "<script>alert('Необходимо заполнить поле имя')</script>";
      }
    }
  }
}

function GiveAccess($username, $status)
{
  $_SESSION['root'] = $status;
  $_SESSION['username'] = $username;
  redirect("Location: list.php");
}
?>
