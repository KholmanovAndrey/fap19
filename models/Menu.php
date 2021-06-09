<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Menu extends ActiveRecord {
    
    public static function tableName() {
        return 'menu';
    }

    public function rules() {
        return [
            [['parent_id', 'position', 'publication'], 'integer'],
            [['name', 'alias', 'url'], 'string', 'max' => 255],
            [['alias'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'parent_id' => 'Родительский ID',
            'name' => 'Наименование',
            'alias' => 'Alias',
            'url' => 'Url',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }
}
