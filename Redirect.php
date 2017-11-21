<?php
/* * * * * *
* Скрипт для переадресации пользователя.
* Функции:
* - redirect - отправляет новый заголовок HTTP с адресом для переадресации
* * * * * */
function redirect($page){
  header("Location: $page");
  exit;
}
