<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 07.02.2019
 * Time: 12:48
 */

namespace app\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    public static function tableName() {
        return 'article';
    }

    public function rules() {
        return [
            [['parent_id', 'position', 'publication'], 'integer'],
            [['name', 'alias', 'image'], 'string', 'max' => 255],
            [['description', 'text'], 'string'],
            [['alias'], 'unique'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'alias' => 'Alias',
            'image' => 'Картинка',
            'description' => 'Краткое описание',
            'text' => 'Полный текст',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }
}