<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FbBookingSlot;

/**
 * FbBookingSlotSearch represents the model behind the search form about `common\models\FbBookingSlot`.
 */
class FbBookingSlotSearch extends FbBookingSlot
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'facility'], 'integer'],
            [['price'], 'number'],
            [['time_from', 'time_to', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'peak'], 'safe'],
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
        $query = FbBookingSlot::find();

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
            'price' => $this->price,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
        ]);

        $query->andFilterWhere(['like', 'monday', $this->monday])
            ->andFilterWhere(['like', 'tuesday', $this->tuesday])
            ->andFilterWhere(['like', 'wednesday', $this->wednesday])
            ->andFilterWhere(['like', 'thursday', $this->thursday])
            ->andFilterWhere(['like', 'friday', $this->friday])
            ->andFilterWhere(['like', 'saturday', $this->saturday])
            ->andFilterWhere(['like', 'sunday', $this->sunday])
            ->andFilterWhere(['like', 'peak', $this->peak]);

        return $dataProvider;
    }
}
