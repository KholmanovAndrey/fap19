<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 14.03.2019
 * Time: 14:11
 */

namespace app\controllers;

use app\models\Product;
use app\modules\admin\controllers\AppAdminController;

class ExportController extends AppAdminController {
    /**
     * Экспорт товаров в csv файла
     */
    public function actionExportCSV() {
        $data = "Название товара;Артикль;Цена;Описание;Количество;Производитель\r\n";
        $model = Product::model()->findAll();
        foreach ($model as $value) {
            $data .= $value->name.
                ';' . $value->article .
                ';' . $value->cost .
                ';' . $value->description .
                ';' . $value->count .
                ';' . $value->producer .
                "\r\n";
        }
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="export_' . date('d.m.Y') . '.csv"');
        //echo iconv('utf-8', 'windows-1251', $data); //Если вдруг в Windows будут кракозябры
        Yii::app()->end();
    }
}