<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Product extends ActiveRecord {
    
    public static function tableName() {
        return 'product';
    }

    public function rules() {
        return [
            [['position', 'publication'], 'integer'],
            [['name', 'alias', 'id_product', 'condition', 'bodywork', 'number', 'engine', 'age', 'l_r', 'f_r', 'u_d', 'color', 'noticy', 'price', 'image', 'status', 'authenticity'], 'string', 'max' => 255],
            [['noticy', 'image'], 'string'],
            [['alias'], 'unique'],
        ];
    }

    public function attributeLabels() {
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
