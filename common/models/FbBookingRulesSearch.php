<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FbBookingRules;

/**
 * FbBookingRulesSearch represents the model behind the search form about `common\models\FbBookingRules`.
 */
class FbBookingRulesSearch extends FbBookingRules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'facility', 'group', 'peak', 'range_limit', 'rules_order'], 'integer'],
            [['range_type', 'condition'], 'safe'],
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
        $query = FbBookingRules::find();

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
            'facility' => $this->facility,
            'group' => $this->group,
            'peak' => $this->peak,
            'range_limit' => $this->range_limit,
            'rules_order' => $this->rules_order,
        ]);

        $query->andFilterWhere(['like', 'range_type', $this->range_type])
            ->andFilterWhere(['like', 'condition', $this->condition]);

        return $dataProvider;
    }
}
