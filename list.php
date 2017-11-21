<?php
/* * * * * *
* Скрипт для вывода списка доступных тестов.
* Позволяет перейти к выбранному тесту, либо перейти к удалению его
* * * * * */
require_once('Redirect.php');
session_start();
if (!isset($_SESSION['root'])){
  redirect('index.php');
}
echo "<h1>Список доступных тестов:</h1>";

// Находим все JSON файлы в папке Tests
$tests = glob("Tests/*.json");
if(!empty($tests)){
  foreach ($tests as $file)
  {
    // Получаем имя файла
    $file = basename($file,".json");
    //Создаем ссылку для прохождения этого теста
    echo "<br><a href=\"test.php?t=$file\">$file</a>";
    if ($_SESSION['root']=='1'){
      echo " | ";
      echo "<a href=\"delete_test.php?t=$file\">Удалить $file</a>";
    }
  }
}
else {
  echo "Доступных тестов нет";
}
if ($_SESSION['root'] == '1'){
  echo "<br><a href=\"admin.php\">Загрузить тест</a>";
}
echo "<br><a href=\"exit.php\">Выйти</a>";
