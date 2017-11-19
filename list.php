<?php
session_start();
echo "<h1>Список доступных тестов:</h1>";

// Находим все JSON файлы в папке Tests
foreach (glob("Tests/*.json") as $file) {
  // Получаем имя файла
  $file = basename($file,".json");
  //Создаем ссылку для прохождения этого теста
  echo "<a href=\"test.php?t=$file\">$file</a><br>";
  }
if ($_SESSION['root'] == '1'){
  echo "<a href=\"admin.php\">Загрузить тест</a><br>";
}
echo "<a href=\"exit.php\">Выйти</a>";
