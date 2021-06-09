<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 14.03.2019
 * Time: 14:09
 */

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Category;
use app\modules\admin\models\Product;
use app\modules\admin\controllers\AppAdminController;
use app\modules\admin\models\ProductCategory;
use yii\filters\AccessControl;

class ImportController extends AppAdminController
{
    public $importFile = 'http://gsi-msk.softrazborki.net/export/files/kawasdrom.csv';
    public $pathToFile = 'import.csv';
    public $delimiterRow = '\n';
    public $delimiterCol = ';';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
        ];
    }

    /**
     * Главная страница
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Удаление всех категории
     * @return string
     */
    public function actionDeleteCategories()
    {
        $start = microtime(true);

        Yii::$app->db->createCommand("TRUNCATE category")->execute();

        $message = '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Удаление всех товаров
     * @return string
     */
    public function actionDeleteProducts()
    {
        $start = microtime(true);

        Yii::$app->db->createCommand("TRUNCATE product")->execute();

        $message = '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Импорт всех категории и подкатегории
     * @return string
     */
    public function actionCreateCategory()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);
                    if ($row[2] !== '') {
                        $categories[$row[2]][] = $row[3];
                    }
                }
                $i++;
            }

            $markaSql = "insert ignore into category (parent_id, `name`, alias) values";
            foreach ($categories as $key => $category) {
                $category = array_unique($category);
                $arr[$key] = $category;

                $markaSql .= " (0, '{$key}', '{$this->translit($key)}'),";
            }
            $categories = $arr;
            $markaSql = substr($markaSql,0,-1);
            $markaSql .= ";";
            Yii::$app->db->createCommand($markaSql)->execute();

            $modelSql = "insert ignore into category (parent_id, `name`, alias) values";
            $dbCategories = Category::find()->where(['parent_id' => 0])->all();
            foreach ($dbCategories as $category) {
                foreach ($categories[$category->name] as $model) {
                    if ($model !== '') {
                        $modelSql .= " ({$category->id}, '{$model}', '{$this->translit($model)}'),";
                    }
                }
            }
            $modelSql = substr($modelSql,0,-1);
            $modelSql .= ";";
            Yii::$app->db->createCommand($modelSql)->execute();
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Проверка на существование файла
     * @return bool
     */
    private function isFile()
    {
        if (!file_exists($this->pathToFile) || !is_readable($this->pathToFile)) {
            return false;
        }
        return true;
    }

    /**
     * Импорт удаленного файла
     * @return bool
     */
    private function importFile()
    {
        $urlHeaders = @get_headers($this->importFile);
        // проверяем ответ сервера на наличие кода: 200 - ОК
        if (strpos($urlHeaders[0], '200')) {
            if (!copy($this->importFile, $this->pathToFile)) {
                return false;
            }
        } else {
            return false;
        }
        return true;
    }

    /**
     * Импорт всех товаров из csv файла
     */
    public function actionAll()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);

                    // добавление товара
                    if ($product = Product::find()->where(['id_product' => $row[17]])->one()) {
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
                    } else {
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
                    }
                    $product->save();

                    // добавление родительской категории
                    $category = Category::find()->where(['name' => $row[2], 'parent_id' => 0])->one();
                    if ($row[2] && !$category) {
                        $category = new Category();
                        $category->parent_id = 0;
                        $category->name = $row[2];
                        $category->alias = $this->translit("{$row[2]}");
                        $category->save();
                    }

                    // добавление подкатегории
                    if ($category->id && $row[3] && !$categoryChild = Category::find()->where(['name' => $row[3]])
                            ->andWhere("parent_id = {$category->id}")->one()) {
                        $categoryChild = new Category();
                        $categoryChild->parent_id = $category->id;
                        $categoryChild->name = $row[3];
                        $categoryChild->alias = $this->translit("{$row[3]}");
                        $categoryChild->save();
                    }

                    // добавление связи между категориями и товарами
                    if ($row[2] && !$product_category = ProductCategory::find()
                            ->where(['product_id' => $product->id, 'category_id' => $category->id])->one()
                    ) {
                        $product_category = new ProductCategory();
                        $product_category->product_id = $product->id;
                        $product_category->category_id = $category->id;
                        $product_category->save();
                    }
                    if ($row[3] && !$product_category = ProductCategory::find()
                            ->where(['product_id' => $product->id, 'category_id' => $categoryChild->id])->one()
                    ) {
                        $product_category = new ProductCategory();
                        $product_category->product_id = $product->id;
                        $product_category->category_id = $categoryChild->id;
                        $product_category->save();
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Импорт новых товаров из csv файла
     */
    public function actionAddProduct()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);

                    // добавление товара
                    if (!$product = Product::find()->where(['id_product' => $row[17]])->one()) {
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
                        $product->save();

                        // добавление родительской категории
                        if ($row[2] && !$category = Category::find()->where(['name' => $row[2], 'parent_id' => 0])->one()) {
                            $category = new Category();
                            $category->parent_id = 0;
                            $category->name = $row[2];
                            $category->alias = $this->translit("{$row[2]}");
                            $category->save();
                        }

                        // добавление подкатегории
                        if ($category->id && $row[3] && !$categoryChild = Category::find()->where(['name' => $row[3]])
                                ->andWhere("parent_id = {$category->id}")->one()
                        ) {
                            $categoryChild = new Category();
                            $categoryChild->parent_id = $category->id;
                            $categoryChild->name = $row[3];
                            $categoryChild->alias = $this->translit("{$row[3]}");
                            $categoryChild->save();
                        }

                        // добавление связи между категориями и товарами
                        if ($row[2] && !$product_category = ProductCategory::find()
                                ->where(['product_id' => $product->id, 'category_id' => $category->id])->one()
                        ) {
                            $product_category = new ProductCategory();
                            $product_category->product_id = $product->id;
                            $product_category->category_id = $category->id;
                            $product_category->save();
                        }
                        if ($row[3] && !$product_category = ProductCategory::find()
                                ->where(['product_id' => $product->id, 'category_id' => $categoryChild->id])->one()
                        ) {
                            $product_category = new ProductCategory();
                            $product_category->product_id = $product->id;
                            $product_category->category_id = $categoryChild->id;
                            $product_category->save();
                        }
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Импорт обновлении товаров из csv файла
     */
    public function actionUpdateProduct()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);

                    // обновление товара
                    if ($product = Product::find()->where(['id_product' => $row[17]])->one()) {
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
                        $product->save();


                        // добавление родительской категории
                        if ($row[2] && !$category = Category::find()->where(['name' => $row[2], 'parent_id' => 0])->one()) {
                            $category = new Category();
                            $category->parent_id = 0;
                            $category->name = $row[2];
                            $category->alias = $this->translit("{$row[2]}");
                            $category->save();
                        }

                        // добавление подкатегории
                        if ($category->id && $row[3] && !$categoryChild = Category::find()->where(['name' => $row[3]])
                                ->andWhere("parent_id = {$category->id}")->one()
                        ) {
                            $categoryChild = new Category();
                            $categoryChild->parent_id = $category->id;
                            $categoryChild->name = $row[3];
                            $categoryChild->alias = $this->translit("{$row[3]}");
                            $categoryChild->save();
                        }

                        // добавление связи между категориями и товарами
                        if ($row[2] && !$product_category = ProductCategory::find()
                                ->where(['product_id' => $product->id, 'category_id' => $category->id])->one()
                        ) {
                            $product_category = new ProductCategory();
                            $product_category->product_id = $product->id;
                            $product_category->category_id = $category->id;
                            $product_category->save();
                        }
                        if ($row[3] && !$product_category = ProductCategory::find()
                                ->where(['product_id' => $product->id, 'category_id' => $categoryChild->id])->one()
                        ) {
                            $product_category = new ProductCategory();
                            $product_category->product_id = $product->id;
                            $product_category->category_id = $categoryChild->id;
                            $product_category->save();
                        }
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Импорт цен товаров из csv файла
     */
    public function actionUpdatePrice()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);

                    // добавление товара
                    if ($product = Product::find()->where(['id_product' => $row[17]])->one()) {
                        $product->price = $row[13];
                        $product->save();
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    /**
     * Импорт статуса товаров из csv файла
     */
    public function actionUpdateStatus()
    {
        $start = microtime(true);

        $message = '';

        if (!$this->isFile()) {
            $message .= "<p>Файла {$this->pathToFile} не существует</p>";
        }

        if (!$this->importFile()) {
            $message .= "<p>Файл {$this->importFile} не импортирован</p>";
        }

        if (($handle = fopen($this->pathToFile, 'r')) !== false) {
            $i = 0;
            while (($row = fgetcsv($handle, 2000, $this->delimiterRow)) !== false) {
                if ($i > 0) {
                    $row = explode($this->delimiterCol, $row[0]);

                    // добавление товара
                    if ($product = Product::find()->where(['id_product' => $row[17]])->one()) {
                        $product->status = $row[13];
                        $product->save();
                    }
                }
                $i++;
            }
            fclose($handle);
        }

        $message .= '<p>Время загрузки данных: ' . (microtime(true) - $start) . ' sec.</p>';
        return $this->render('index', compact('message'));
    }

    private function translit($str)
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л',
            'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ',
            'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и',
            'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч',
            'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', '.', ' ', '>', '<');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L',
            'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch',
            'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh',
            'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h',
            'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '', '-', '', '');
        return strtolower(trim(str_replace($rus, $lat, $str)));
    }

    public function debug($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }
}