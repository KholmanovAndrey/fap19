<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $alias
 * @property string $logo
 * @property int $position
 * @property int $publication
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    function getCategory(){
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'position', 'publication'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 255],
            [['logo'], 'string', 'max' => 50],
            [['alias'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'parent_id' => 'Род. категория',
            'name' => 'Наименование',
            'alias' => 'Alias',
            'logo' => 'Логотип',
            'position' => 'Позиция',
            'publication' => 'Публикация',
        ];
    }
}
