<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaskUser as TaskUserModel;

/**
 * TaskUser represents the model behind the search form of `app\models\TaskUser`.
 */
class TaskUser extends TaskUserModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_user_id', 'task_id', 'user_id'], 'integer'],
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
        $query = TaskUserModel::find();

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
            'task_user_id' => $this->task_user_id,
            'task_id' => $this->task_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
