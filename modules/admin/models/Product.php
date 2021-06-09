<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $id_product
 * @property string $name
 * @property string $alias
 * @property string $condition
 * @property string $bodywork
 * @property string $number
 * @property string $engine
 * @property string $age
 * @property string $l_r
 * @property string $f_r
 * @property string $u_d
 * @property string $color
 * @property string $noticy
 * @property string $price
 * @property string $image
 * @property string $status
 * @property string $authenticity
 * @property int $position
 * @property int $publication
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noticy', 'image'], 'string'],
            [['position', 'publication'], 'integer'],
            [['id_product', 'name', 'alias'], 'string', 'max' => 255],
            [['condition', 'bodywork', 'number', 'engine', 'age', 'l_r', 'f_r', 'u_d', 'color', 'price', 'status', 'authenticity'], 'string', 'max' => 50],
            [['alias'], 'unique'],
            [['id_product'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'alias' => 'Alias',
            'id_product' => 'ID из SCV файла',
            'condition' => 'Новый/Б.у',
            'bodywork' => 'Кузов',
            'number' => 'Номер',
            'engine' => 'Двигатель',
            'age' => 'Год',
            'l_r' => 'L-R',
            'f_r' => 'F-R',
            'u_d' => 'U-D',
            'color' => 'Цвет',
            'noticy' => 'Примечание',
            'price' => 'Цена',
            'image' => 'Фотография',
            'status' => 'Статус',
            'authenticity' => 'Аутентичность',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }

    public function getCategory(){
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('product_category', ['product_id' => 'id']);
    }

    public function getProductCategory(){
        return $this->hasMany(ProductCategory::className(), ['category_id' => 'id']);
    }
}
