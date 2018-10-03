<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'brend_id', 'meta_id', 'lenght', 'height', 'width', 'weight', 'display', 'visible', 'for_sale', 'replace_product_id', 'show_description', 'watermark', 'quantity', 'yamt_category', 'type_id'], 'integer'],
            [['name', 'articul', 'offer', 'h1', 'title', 'description', 'keywords', 'seo_description', 'thumbnail', 'model', 'yamt_description'], 'safe'],
            [['price', 'discounted_price', 'purchase_cost'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'product_id' => $this->product_id,
            'brend_id' => $this->brend_id,
            'meta_id' => $this->meta_id,
            'lenght' => $this->lenght,
            'height' => $this->height,
            'width' => $this->width,
            'weight' => $this->weight,
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'display' => $this->display,
            'visible' => $this->visible,
            'for_sale' => $this->for_sale,
            'replace_product_id' => $this->replace_product_id,
            'show_description' => $this->show_description,
            'watermark' => $this->watermark,
            'quantity' => $this->quantity,
            'purchase_cost' => $this->purchase_cost,
            'yamt_category' => $this->yamt_category,
            'type_id' => $this->type_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'articul', $this->articul])
            ->andFilterWhere(['like', 'offer', $this->offer])
            ->andFilterWhere(['like', 'h1', $this->h1])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'thumbnail', $this->thumbnail])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'yamt_description', $this->yamt_description]);

        return $dataProvider;
    }
}
