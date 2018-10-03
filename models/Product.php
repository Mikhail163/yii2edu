<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $product_id
 * @property int $brend_id
 * @property int $meta_id
 * @property int $lenght
 * @property int $height
 * @property int $width
 * @property int $weight
 * @property string $name
 * @property string $articul
 * @property string $offer
 * @property string $h1
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $seo_description
 * @property string $price
 * @property string $discounted_price
 * @property string $image
 * @property string $image_2
 * @property string $image_3
 * @property string $image_4
 * @property string $image_5
 * @property string $image_6
 * @property string $image_7
 * @property string $image_8
 * @property string $image_9
 * @property string $image_10
 * @property string $thumbnail
 * @property int $display
 * @property int $visible
 * @property int $for_sale
 * @property int $replace_product_id
 * @property int $show_description
 * @property int $watermark
 * @property int $quantity
 * @property string $purchase_cost
 * @property int $yamt_category
 * @property string $model
 * @property string $yamt_description
 * @property int $type_id
 */

/**
 * 
 * Структура запроса sql для товара находится в app\config\product.sql
 *
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brend_id', 'meta_id', 'lenght', 'height', 'width', 'weight', 'name', 'articul', 'offer', 'h1', 'title', 'description', 'keywords', 'seo_description', 'price', 'model'], 'required'],
            [['brend_id', 'meta_id', 'lenght', 'height', 'width', 'weight', 'display', 'visible', 'for_sale', 'replace_product_id', 'show_description', 'watermark', 'quantity', 'yamt_category', 'type_id'], 'integer'],
            [['description'], 'string'],
            [['price', 'discounted_price', 'purchase_cost'], 'number'],
            [['name', 'offer', 'h1', 'image_6', 'image_7', 'image_8', 'image_9', 'image_10'], 'string', 'max' => 100],
            [['articul'], 'string', 'max' => 22],
            [['title', 'keywords', 'seo_description'], 'string', 'max' => 255],
            [['image', 'image_2', 'image_3', 'image_4', 'image_5', 'thumbnail'], 'string', 'max' => 150],
            [['model'], 'string', 'max' => 50],
            [['yamt_description'], 'string', 'max' => 175],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'ID',
            'brend_id' => 'Бренд',
            'meta_id' => 'Meta ID',
            'lenght' => 'Длина',
            'height' => 'Высота',
            'width' => 'Ширина',
            'weight' => 'Вес',
            'name' => 'Название',
            'articul' => 'Артикул',
            'offer' => 'Спец. предложение',
            'h1' => 'H1',
            'title' => 'Title',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'seo_description' => 'Seo Description',
            'price' => 'Цена',
            'discounted_price' => 'Цена со скидкой',
            'thumbnail' => 'Thumbnail',
            'display' => 'Display',
            'visible' => 'Visible',
            'for_sale' => 'For Sale',
            'replace_product_id' => 'Replace Product ID',
            'show_description' => 'Show Description',
            'watermark' => 'Watermark',
            'quantity' => 'Quantity',
            'purchase_cost' => 'Purchase Cost',
            'yamt_category' => 'Yamt Category',
            'model' => 'Model',
            'yamt_description' => 'Yamt Description',
            'type_id' => 'Type ID',
        ];
    }
}
