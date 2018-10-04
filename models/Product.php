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
 * Структура запроса sql для товаров находится в app\config\product.sql
 *
 */
class Product extends \yii\db\ActiveRecord
{
	const SCENARIO_CREATE = 'create';
	const SCENARIO_UPDATE = 'update';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function scenarios() {
    	return [
    			self::SCENARIO_CREATE => [
    					'brend_id',
    					'meta_id',
    					'lenght',
    					'height',
    					'width',
    					'weight',
    					'name',
    					'articul',
    					'offer',
    					'h1',
    					'title',
    					'description',
    					'keywords',
    					'seo_description',
    					'price',
    					'discounted_price',
    					'thumbnail',
    					'display',
    					'visible',
    					'for_sale',
    					'replace_product_id',
    					'show_description',
    					'watermark',
    					'quantity',
    					'purchase_cost',
    					'yamt_category',
    					'model',
    					'yamt_description',
    					'type_id',
    			],
    			self::SCENARIO_UPDATE => [
    					'brend_id',
    					'!meta_id',
    					'lenght',
    					'height',
    					'width',
    					'weight',
    					'name',
    					'articul',
    					'offer',
    					'h1',
    					'title',
    					'description',
    					'keywords',
    					'seo_description',
    					'price',
    					'discounted_price',
    					'thumbnail',
    					'display',
    					'visible',
    					'for_sale',
    					'replace_product_id',
    					'show_description',
    					'watermark',
    					'quantity',
    					'purchase_cost',
    					'yamt_category',
    					'model',
    					'yamt_description',
    					'type_id',
    			],
    	];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brend_id', 'meta_id', 'lenght', 'height', 'width', 'weight', 'name', 'h1', 'title', 'description', 'keywords', 'seo_description', 'price'], 'required'],
            [['brend_id', 'meta_id', 'lenght', 'height', 'width', 'weight', 'display', 'visible', 'for_sale', 'replace_product_id', 'show_description', 'watermark', 'quantity', 'yamt_category', 'type_id'], 'integer'],
            [['description'], 'string'],
        	// поставим ограничение на цену от 0 до 1 000 000 рублей 
            	
            [['offer', 'h1'], 'string', 'max' => 100, 'min' => 0],
        	[['name'], 'string', 'max' => 100],
        	// уберем лишние пробелы и очистим от html тегов name
        	[['name'], 'filter', 'filter' => function($value) {
        		return strip_tags(trim($value));
        	}],
        	[['articul', 'offer'], 'string', 'max' => 22, 'min' => 0],
            [['title', 'keywords', 'seo_description'], 'string', 'max' => 255, 'min' => 0],
            [['thumbnail'], 'string', 'max' => 150, 'min' => 0],
            [['model'], 'string', 'max' => 50, 'min' => 0],
            [['yamt_description'], 'string', 'max' => 175],
            [['display', 'visible', 'for_sale', 'show_description'], 'default',  'value' => 1],
            [['replace_product_id', 'watermark', 'quantity'], 'default',  'value' => 0],
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
