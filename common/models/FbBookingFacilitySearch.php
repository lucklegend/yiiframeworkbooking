<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FbBookingFacility;

/**
 * FbBookingFacilitySearch represents the model behind the search form about `common\models\FbBookingFacility`.
 */
class FbBookingFacilitySearch extends FbBookingFacility
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'group', 'bookday_start', 'bookday_end', 'cancel_date', 'unit_time', 'deposit', 'album_id', 'published'], 'integer'],
            [['name', 'rulestype', 'rulescondition', 'notes', 'attachment', 'image', 'album_url'], 'safe'],
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
        $query = FbBookingFacility::find();

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
            'group' => $this->group,
            'bookday_start' => $this->bookday_start,
            'bookday_end' => $this->bookday_end,
            'cancel_date' => $this->cancel_date,
            'unit_time' => $this->unit_time,
            'deposit' => $this->deposit,
            'album_id' => $this->album_id,
            'published' => $this->published,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'rulestype', $this->rulestype])
            ->andFilterWhere(['like', 'rulescondition', $this->rulescondition])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'attachment', $this->attachment])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'album_url', $this->album_url]);

        return $dataProvider;
    }
}
