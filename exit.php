<?php
/* * * * * *
* Скрипт для деавторизации пользователя.
* Функция
*   redirect - перенаправляет на другу страницу
* * * * * */
require_once('Redirect.php');
session_destroy();
redirect('index.php');
