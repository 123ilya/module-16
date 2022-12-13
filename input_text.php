<?php
    
    require_once 'autoload.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

?>

    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Форма для отправки текстов</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <h1 class="item1">Форма для отправки текстов в "ТЕЛЕГРАФ" </h1>
    <form class="item2" method="post" action="input_text.php">
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
    if ($_POST['text'] and $_POST['author']) {
        $telegraphText = new TelegraphText($_POST['author'], $_POST['author']);
        $fileStorage = new FileStorage();
        $fileStorage->create($telegraphText);
//        Проверяем заполнено ли поле email в форме. Если да, то отправляем текст на это email.
        if ($_POST['email']) {
            $addressee = $_POST['email'];
            $text = $_POST['text'];
            $mail = new PHPMailer(true);
//        ---
            try {
                $mail->isSMTP();                   // Отправка через SMTP
                $mail->Host = 'smtp.yandex.ru';  // Адрес SMTP сервера
                $mail->SMTPAuth = true;          // Enable SMTP authentication
                $mail->Username = 'ilyasobolev8400';       // ваше имя пользователя (без домена и @)
                $mail->Password = 'dvqyslasbjrcqame';    // ваш пароль
                $mail->SMTPSecure = 'ssl';         // шифрование ssl
                $mail->Port = 465;               // порт подключения
                
                $mail->setFrom('ilyasobolev8400@yandex.ru', 'ilya');    // от кого
                $mail->addAddress($addressee, 'addressee'); // кому
//            content
                $mail->isHTML();
                $mail->Subject = 'Тест';
                $mail->Body = $text;
                $mail->AltBody = $text;
                $mail->send();
                echo '<div class="message item3 ok"><span> Письмо отправлено!!!</span></div>';
            } catch (Exception $e) {
                echo "<div class='message item3 error'><span>Сообщение не доставленно. Ошибка: $mail->ErrorInfo</span></div>";
            }
//            -----
        }
    }
    unset($_POST['text']);
    unset($_POST['author']);
    unset($_POST['email']);
    

