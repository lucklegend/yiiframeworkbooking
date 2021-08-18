<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UsersUnit;

/**
 * UsersUnitSearch represents the model behind the search form about `common\models\UsersUnit`.
 */
class UsersUnitSearch extends UsersUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'unit_block', 'unit_level', 'unit_type', 'bookable', 'published'], 'integer'],
            [['unit_name'], 'safe'],
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
        $query = UsersUnit::find();

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
            'unit_block' => $this->unit_block,
            'unit_level' => $this->unit_level,
            'unit_type' => $this->unit_type,
            'bookable' => $this->bookable,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'unit_name', $this->unit_name]);

        return $dataProvider;
    }
}
