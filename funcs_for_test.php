<?php
function build_test($path)
{
    //если все условия соблюдены - обрабатываем файл с тестом
    $json = file_get_contents($path);
    $json = json_decode($json, true);
    $count_questions = count($json);
    echo "<h2>Тест ".basename($path, '.json')."</h2>";
    echo "<h3>Ваше имя: ".$_SESSION['username']."</h3>";
?>
    <form action="" method="POST">
        <?php
        foreach ($json as $name => $question)
        {
            echo "<fieldset>".PHP_EOL."<legend>";
            echo $question["question"]."</legend>";
            foreach ($question['answers'] as $key => $answer)
            {
              echo "<label><input type=\"radio\" name=\"$name\" value=\"$answer\">$answer</label>".PHP_EOL;
            }
            echo PHP_EOL."</fieldset>";
        }?>
        <input type="submit" value="Отправить">
    </form>
    <!-- Ссылка для возврата к списку тестов -->
    <a href="list.php">Перейти к списку тестов</a><br>
    <?php
    return check_answers($count_questions, $json);
}

function create_diploma($name, $points)
{
    if (!empty($name) && !empty($points)) {
        //require_once('Redirect.php');
        $text = "Поздравляем, $name" . PHP_EOL . "Ваши баллы:" . strval($points);
        $image = imagecreatetruecolor(250, 250);
        $backcolor = imagecolorallocate($image, 255, 224, 221);
        $textcolor = imagecolorallocate($image, 129, 15, 90);

        $fontFile = __DIR__ . '/assets/font.ttf';

        if (!file_exists($fontFile)) {
            echo "Файл шрифта не найден";
            exit;
        }
        $imBox = imagecreatefrompng(__DIR__ . '/assets/trophy.png');

        imagefill($image, 0, 0, $backcolor);
        imagecopy($image, $imBox, 50, 50, 0, 0, 120, 120);
        imagettftext($image, 18, 0, 15, 100, $textcolor, $fontFile, $text);
        imagepng($image, 'cert.png');
        header('Content-Type: image/png');
        // Вывод картинки в теле страницы вместо отправки через заголовок
        imagepng($image);
        imagedestroy($image);
    }
}

function check_answers($count_questions, $json)
{
    /* Обработка ответов */
    // Получаем переданные ответы
    $answers = $_REQUEST;
    $username = null;
    $point = null;
    // Убираем номер теста, оставляем только ответы на вопросы
    unset($answers['t']);

    if (isset($answers['username'])) {
        $username = $answers['username'];
        unset($answers['username']);
    }
    // Если массив ответов не пуст, и число ответов равно числу вопросов
    // подсчитываем число верных ответов
    if (!empty($answers) && ($count_questions == count($answers)) && !empty($username)) {
        $point = 0;
        // Проверяем ответы на каждый вопрос
        foreach ($answers as $question => $answer) {
            if ($json[$question]['correct'] == $answer) {
                $point += 1;
            }
        }
    } // Если есть пустые поля - говорим об этом пользователю
    else {
        echo "<script>alert('Необходимо заполнить все поля')</script>";
    }
    return array($username, $point);
}
