<?php
/* * * * * *
* Страница admin.
* Позволяет авторизированным пользователям загрузить новый тест.
* Доступ для гостей закрыт.
* * * * * */
session_start();
if ($_SESSION['root'] != '1'){
  header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
  echo"<H1>403 Forbidden</H1>";
  exit();
}
else{
  require_once('Redirect.php');
  // Обрабатываем загруженный файл
  if(isset($_FILES['userfile'])){
    $file = $_FILES['userfile'];
    $path = $file['name'];
    // Если файл JSON, то сохраняем его в папку с тестами
    if(pathinfo($file['name'])['extension'] === 'json'){
      if (move_uploaded_file($file['tmp_name'], "Tests/".$path))
      {
        file_put_contents('log.txt', $_SESSION['username']." добавил $file", FILE_APPEND);
        // После успешной загрузки файла перенаправляем на список тестов
        redirect('list.php');
      }
      else {
        echo "Произошла ошибка при загрузке файла";
      }
    }
    // иначе выдаем сообщение об ошибке
    else {
      echo "Загружен неверный файл";
    }
  }
}
?>
<!-- Форма admin для загрузки новых тестов -->
<!DOCTYPE html>
<meta charset="utf-8">
<!-- Форма загрузки теста -->
<form method="post" enctype="multipart/form-data" name="upload_form" action="admin.php">
  <input type="file" name="userfile">
  <input type="submit" value="UPLOAD">
</form>
<br>
<!-- Ссылка для возврата к списку тестов -->
<a href="list.php">Перейти к списку тестов</a>
