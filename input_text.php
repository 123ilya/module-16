<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require_once 'autoload.php';
?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Форма для отправки текстов</title>
    </head>
    <body>
    <h1>Форма для отправки текстов в "ТЕЛЕГРАФ" </h1>
    <form method="post" action="input_text.php">
        <label>Автор:
            <input type="text" name="author">
        </label>
        <label>
            Текст:
            <input type="text" name="text">
        </label>
        <label>
            Email:
            <input type="email" name="email">
        </label>
        <label>
            <input type="submit" value="Отправить">
        </label>
    </form>
    </body>
    </html>
<?php
    if ($_POST['text'] and $_POST['author']){
        $telegraphText = new TelegraphText($_POST['author'],$_POST['author']);
        $fileStorage=new FileStorage();
        $fileStorage->create($telegraphText);
    }
//    Рассылка почты
//    Создаём экземпляр класса PHPMailer
// Создаем письмо
    $mail = new PHPMailer();
    $mail->isSMTP();                   // Отправка через SMTP
    $mail->Host   = 'smtp.yandex.ru';  // Адрес SMTP сервера
    $mail->SMTPAuth   = true;          // Enable SMTP authentication
    $mail->Username   = 'ilyasobolev8400';       // ваше имя пользователя (без домена и @)
    $mail->Password   = 'dvqyslasbjrcqame';    // ваш пароль
    $mail->SMTPSecure = 'ssl';         // шифрование ssl
    $mail->Port   = 465;               // порт подключения
    
    $mail->setFrom('ilyasobolev8400@yandex.ru', 'ilya');    // от кого
    $mail->addAddress('ilyasobolev8400@yandex.ru', 'Вася Петров'); // кому
    
    $mail->Subject = 'Тест';
    $mail->msgHTML("<html><body>
                <h1>Здравствуйте!</h1>
                <p>Это тестовое письмо.</p>
                </html></body>");
// Отправляем
    if ($mail->send()) {
        echo 'Письмо отправлено!';
    } else {
        echo 'Ошибка: ' . $mail->ErrorInfo;
    }