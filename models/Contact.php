<?php
/**
 * Created by PhpStorm.
 * User: Программист
 * Date: 05.07.2019
 * Time: 12:48
 */

namespace app\models;


use yii\db\ActiveRecord;

class Contact extends ActiveRecord {

    public static function tableName() {
        return 'contact';
    }

    public function rules() {
        return [
            [['publication'], 'integer'],
            [['office', 'adress', 'work'], 'string', 'max' => 255],
            [['phone', 'email'], 'string'],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'office' => 'Офис',
            'adress' => 'Адрес',
            'work' => 'Время работы',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'publication' => 'Публикация',
        ];
    }

}