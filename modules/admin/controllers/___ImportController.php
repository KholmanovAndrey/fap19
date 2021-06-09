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
    public function actionImport() {
        $start = microtime(true);

        // достаем все товары из базы данных
        $products = Product::find()->select('id_product')->asArray()->all();
        //$this->debug($products);

        //путь к файлу
        //$this->pathToFile = 'http://gsi-msk.softrazborki.net/export/files/kawasdrom.csv';
        $this->pathToFile = 'import.csv';
        // код, если файл отсутствует
        if (!file_exists($this->pathToFile) || !is_readable($this->pathToFile)) {
            // TODO код, если файл отсутствует
        }
        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            $query = '';
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i>0) {
                    $row = explode($this->delimiterCol, $row[0]);
                    //$this->debug($row);break;

                    if (!$this->checkingProductExists($products, $row[17])) {
                        $query .= '<br>'.$row[17];

                        $product = new Product();
                        $product->id_product = $row[17];
                        $product->name = $row[0];
                        $product->condition = $row[1];
                        $product->bodywork = $row[4];
                        $product->number = $row[5];
                        $product->engine = $row[6];
                        $product->age = $row[7];
                        $product->l_r = $row[8];
                        $product->f_r = $row[9];
                        $product->u_d = $row[10];
                        $product->color = $row[11];
                        $product->noticy = $row[12];
                        $product->price = $row[13];
                        $product->image = $row[14];
                        $product->status = $row[15];
                        $product->authenticity = $row[16];
                        $product->alias = $this->translit("{$row[2]}-{$row[0]}-{$row[1]}-$i");
                        $product->update(false);

                    }

                }
                $i++;
            }
            //echo "QUERY: $query <br><br><br>";
            echo "COUNT: $i".PHP_EOL;
            fclose($handle);
        }

        echo ' TIME: '.(microtime(true) - $start).' sec.';
    }

    /**
     * Проверка на существование продукта в массиве
     * @param $products
     * @param $id
     * @return bool
     */
    private function checkingProductExists($products, $id){
        if ($products) {
            foreach ($products as $product) {
                if ($product['id_product'] == $id) {
                    return true;
                }
            }
        }
        return false;
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