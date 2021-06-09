<?php
/*
*
*  Name   : CSV->MySQL Importer
*  Ver    : 2.2
*  Author : Dmitriy Ilichev
*  WebSite: http://dmitriyilichev.com/
*
*/

setlocale (LC_ALL, 'nl_NL'); // Преобразуем каракули в кириллицу

/*
*
*  Настройки
*
*/

$options = array(
    'enable'        => true, // Скрипт работает только если значение TRUE
    /* Настройки CSV */
    'filename'      => 'import.csv', // Имя файла CSV. Находиться должен в одной папке со скриптом
    'delimiter'     => ';', // Какой разделитель используется
    /* Настройки подключения к БД */
    'db_server'     => 'localhost', // Сервер БД
    'db_user'       => 'root', // Имя пользователя
    'db_password'   => '', // Пароль
    'db_base'       => 'data' // Имя базы данных

    );

if(!$options['enable']) die('Скрипт отключен, дальнейшая обработка данных невозможна!');

/*
*
*  Функции скрипта
*
*/

// Основная функция, из импортируемого файла выбираем данные в массив
// !Во время первой итерации значения первой строки будут являться ключами ассоциативного массива!
 
function csv_to_array($filename='') {
    if(!file_exists($filename) || !is_readable($filename)){
        return FALSE;
    }
    global $options;
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $options['delimiter'])) !== FALSE) {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}
 
// Используется, если необходимо убрать ВСЕ (!!!) пробелы из строки
// Например цена в виде Х ХХХ, а в базе нужно ХХХХ
 
function space_off($str) {
    if(!empty($str)) {
        return str_replace(" ", "", $str);
    }
    else {
        return FALSE;
    }
}
 
// Просто функция транслитизации, Заменяем кириллицу латиницей, вместо пробела ставим нижнее подчеркивание
// Удобно, если необходимо из названия сделать URL
 
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
    return str_replace($rus, $lat, $str);
}
 
/*
*
*  / Функции скрипта
*
*  Подключаемся к Базе Данных
*
*/
 
$link = mysql_connect($options['db_server'], $options['db_user'], $options['db_password']);
if (!$link) {
    die('Ошибка соединения: ' . mysql_error());
}
 
// Указываем, что общаемся с БД только в UTF-8
 
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");
 
// Выбираем интересующую нас Базу
 
$db_selected = mysql_select_db($options['db_base'], $link);
if (!$db_selected) {
    die ('Не удалось выбрать базу db_data: ' . mysql_error());
}
 
// Отключаем индексацию таблицы, для максимального быстродействия 

mysql_query("ALTER TABLE `".$options['db_base']."` DISABLE KEYS");

foreach (csv_to_array($options['filename']) as $val) {
 
    // Тут собственно делаем запросы в соответствии с задачей

}

// Включаем индексацию таблицы 

mysql_query("ALTER TABLE `".$options['db_base']."` ENABLE KEYS");
 
// Закрываем соединение с БД
 
mysql_close($link);
 
?> 