<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Category extends ActiveRecord {
    
    public static function tableName() {
        return 'category';
    }

    public function rules() {
        return [
            [['parent_id', 'position', 'publication'], 'integer'],
            [['name', 'alias', 'logo'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский ID',
            'name' => 'Наименование',
            'alias' => 'Alias',
            'logo' => 'Картинка',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }
    
    public function getProduct(){
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('product_category', ['category_id' => 'id']);
    }

}
