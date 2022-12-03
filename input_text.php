<?php
    
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
    
    
   
    
       