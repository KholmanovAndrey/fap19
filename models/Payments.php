<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property string $id
 * @property string $name Наименование способа платежа
 * @property string $discription Описание способа платежа
 *
 * @property Order[] $orders
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payments';
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
            'name' => 'Способ оплаты',
            'discription' => 'Описание',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['payment_id' => 'id']);
    }
}
