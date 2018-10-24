<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Brend;

/**
 * BrendSearch represents the model behind the search form of `app\models\Brend`.
 */
class BrendSearch extends Brend
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brend_id', 'city_id', 'country_id', 'days_delivery_stock', 'days_delivery_order'], 'integer'],
            [['name', 'description', 'image'], 'safe'],
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
        $query = Brend::find();

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
            'brend_id' => $this->brend_id,
            'city_id' => $this->city_id,
            'country_id' => $this->country_id,
            'days_delivery_stock' => $this->days_delivery_stock,
            'days_delivery_order' => $this->days_delivery_order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
