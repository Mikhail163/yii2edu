<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brend".
 *
 * @property int $brend_id
 * @property string $name
 * @property string $description
 * @property string $image
 * @property int $city_id
 * @property int $country_id
 * @property int $days_delivery_stock
 * @property int $days_delivery_order
 */
class Brend extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'brend';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['city_id', 'country_id', 'days_delivery_stock', 'days_delivery_order'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 1000, 'min' => 0],
            [['image'], 'string', 'max' => 150, 'min' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brend_id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'image' => 'Логотип',
            'city_id' => 'Город дистрибьютера',
            'country_id' => 'Страна',
            'days_delivery_stock' => 'Срок доставки со склада',
            'days_delivery_order' => 'Срок доставки на заказ',
        ];
    }
}
