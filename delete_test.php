<?php
/* * * * * *
* Скрипт для удаления теста.
* Позволяет авторизированным пользователям удалить тест.
* Доступ для гостей закрыт.
* Функции:
* - delete_test - проверяет статус пользователя и удаляет запрашиваемый файл
* - check_test - проверяет наличие выбранного теста и возвращаяет путь к файлу
* - redirect - перенаправляет на другу страницу
* * * * * */
require_once('test.php');
require_once('Redirect.php');
function delete_test($file)
{
  if ($_SESSION['root'] == 1){
    unlink($file);
    file_put_contents('log.txt', $_SESSION['username']." удалил $file", FILE_APPEND);
  }
  else {
    header($_SERVER['SERVER_PROTOCOL'].'403 Forbidden');
    echo"<H1>403 Forbidden</H1>";
    exit();
  }
}
$path = check_test();
delete_test($path);
redirect('list.php');
