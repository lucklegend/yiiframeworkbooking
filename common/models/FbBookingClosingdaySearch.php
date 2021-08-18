<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FbBookingClosingday;

/**
 * FbBookingClosingdaySearch represents the model behind the search form about `common\models\FbBookingClosingday`.
 */
class FbBookingClosingdaySearch extends FbBookingClosingday
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'published'], 'integer'],
            [['facility', 'title', 'notes', 'date_from', 'date_to', 'time_from', 'time_to'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = FbBookingClosingday::find();

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
            'id' => $this->id,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'facility', $this->facility])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
