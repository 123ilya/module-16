<?php

function loaderEntities($className)
{
    require_once 'entities' . '/' . $className . '.php';
}
//Подключаем автозагрузчик Composer к проекту
require_once 'vendor/autoload.php';
    spl_autoload_register('loaderEntities');
