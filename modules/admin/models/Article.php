<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $name
 * @property string $alias
 * @property string $image
 * @property string $description
 * @property string $text
 * @property int $position
 * @property int $publication
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'text'], 'string'],
            [['position', 'publication'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
            [['alias'], 'unique'],
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
            'alias' => 'Транслит',
            'image' => 'Картинка',
            'description' => 'Описание',
            'text' => 'Текст',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }
}
