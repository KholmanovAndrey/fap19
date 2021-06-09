<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 14.03.2019
 * Time: 14:09
 */

namespace app\modules\admin\controllers;

use app\modules\admin\models\Category;
use app\modules\admin\models\Product;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\ProductCategory;

class ImportController extends AppAdminController {
    public $pathToFile;
    public $delimiterRow = '\n';
    public $delimiterCol = ';';
    /**
     * Импорт товаров из csv файла
     */
    public function actionImport2() {
        //путь к файлу
        $this->pathToFile = 'http://gsi-msk.softrazborki.net/export/files/kawasdrom.csv';
        // код, если файл отсутствует
        if (!file_exists($this->pathToFile) || !is_readable($this->pathToFile)) {
            // TODO код, если файл отсутствует
        }
        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {

            }
            fclose($handle);
        }
    }

    public function actionImport(){
        $table = 'product'; 		// Имя таблицы для импорта
        $afields = array("column1", "@dummy", "column2", "@dummy", "column3"); 		// Массив строк - имен полей таблицы
        $filename = 'import.csv'; 	 	// Имя CSV файла, откуда берется информация
        // (путь от корня web-сервера)
        $delim=',';  		// Разделитель полей в CSV файле
        $enclosed='"';  	// Кавычки для содержимого полей
        $escaped='\\'; 	 	// Ставится перед специальными символами
        $lineend='\\r\\n';   	// Чем заканчивается строка в файле CSV
        $hasheader=TRUE;    // Пропускать ли заголовок CSV

        if($hasheader) $ignore = "IGNORE 1 LINES ";
        else $ignore = "";
        $q_import =
            "LOAD DATA INFILE '".
            $_SERVER['DOCUMENT_ROOT'].$filename."' INTO TABLE ".$table." ".
            "FIELDS TERMINATED BY '".$delim."' ENCLOSED BY '".$enclosed."' ".
            "    ESCAPED BY '".$escaped."' ".
            "LINES TERMINATED BY '".$lineend."' ".
            $ignore.
            "(".implode(',', $afields).")"
        ;
        //return mysql_query($q_import);
    }

    private function translit($str) {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л',
            'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ',
            'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и',
            'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч',
            'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', '.', ' ');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch',
            'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh',
            'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h',
            'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '', '-');
        return strtolower(trim(str_replace($rus, $lat, $str)));
    }

    public function debug($data){
        echo "<pre>"; print_r($data); echo"</pre>";
    }
}