<?php
/* * * * * *
* Страница для прохождения теста.
* Функции:
* - build_test - выводит тест в виде HTML
* - check_answers - проверяет правильность ответов
* - create_diploma - создает картинку с результатами тест
* - check_test - проверяет наличие файла с тестом
* * * * * */
require_once('Redirect.php');
session_start();
if (!isset($_SESSION['root'])){
  redirect('index.php');
}

// Проверяем переданное название теста
function check_test()
{
  $test = $_GET['t'];
  // Если не передан параметр t, то выдаем ошибку 400
  if (empty($test)) {
    // в случае неверных параметров - возвращаем к списку тестов
    //var_dump($_SERVER);
    header($_SERVER['SERVER_PROTOCOL'].' 400 Bad request');
    exit(1);
  }
  // Составляем путь до файла
  $path = "Tests/$test.json";
  // Если файл не существует - выдаем ошибку 404
  if (!file_exists($path)){
    header($_SERVER['SERVER_PROTOCOL'].' 404 Not found');
    exit(1);
  }
  // Возвращаем путь к тесту
  return $path;
}
require_once('funcs_for_test.php');
send_diploma();
$path_to_test = check_test();
list($name, $points) = build_test($path_to_test);
create_diploma($name, $points, $_GET['t']);
