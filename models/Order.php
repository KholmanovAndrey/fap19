<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property string $id
 * @property string $seller_id
 * @property string $shopper_id
 * @property string $delivery_id
 * @property string $payment_id
 * @property string $qty Общее количество заказанных товарных позиций
 * @property double $sum Итого = количство + цена
 * @property string $status
 * @property int $isPaid
 * @property string $name ФИО
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property string $comment Опишите ваши пожелания при оформлений заказа
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Delivery $delivery
 * @property Payments $payment
 * @property OrderItems[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seller_id', 'shopper_id', 'delivery_id', 'payment_id'], 'required'],
            [['seller_id', 'shopper_id', 'delivery_id', 'payment_id', 'qty'], 'integer'],
            [['sum'], 'number'],
            [['status', 'comment'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 255],
            [['delivery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Delivery::className(), 'targetAttribute' => ['delivery_id' => 'id']],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payments::className(), 'targetAttribute' => ['payment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seller_id' => 'Seller ID',
            'shopper_id' => 'Shopper ID',
            'delivery_id' => 'Доставка',
            'payment_id' => 'Оплата',
            'qty' => 'Qty',
            'sum' => 'Sum',
            'status' => 'Статус',
            'isPaid' => 'Оплата',
            'name' => 'ФИО',
            'email' => 'Email',
            'phone' => 'Телефон',
            'address' => 'Адрес',
            'comment' => 'Комментарии',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDelivery()
    {
        return $this->hasOne(Delivery::className(), ['id' => 'delivery_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Payments::className(), ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransportCompany()
    {
        return $this->hasOne(TransportCompany::className(), ['id' => 'transport_id']);
    }
}
