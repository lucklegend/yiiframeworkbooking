<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Visitors;

/**
 * VisitorsSearch represents the model behind the search form about `common\models\Visitors`.
 */
class VisitorsSearch extends Visitors
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'meet_whom', 'gate_no', 'updated_by'], 'integer'],
            [['name', 'phone', 'meet_for', 'relationship', 'entry_time', 'exit_time'], 'safe'],
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
        $query = Visitors::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['entry_time' => 'DESC']];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'meet_whom' => $this->meet_whom,
            'entry_time' => $this->entry_time,
            'exit_time' => $this->exit_time,
            'gate_no' => $this->gate_no,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'meet_for', $this->meet_for])
            ->andFilterWhere(['like', 'relationship', $this->relationship]);

        return $dataProvider;
    }
}
