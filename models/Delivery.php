<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "delivery".
 *
 * @property string $id
 * @property string $name Наименование способа доставки
 * @property string $discription Описание способа доставки
 *
 * @property Order[] $orders
 */
class Delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['discription'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Способ доставки',
            'discription' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['delivery_id' => 'id']);
    }
}
