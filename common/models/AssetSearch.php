<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Asset;

/**
 * AssetSearch represents the model behind the search form about `common\models\Asset`.
 */
class AssetSearch extends Asset
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category', 'purchase_from', 'amc_by', 'user_unit', 'user_id', 'status'], 'integer'],
            [['name', 'model', 'brand', 'code', 'purchase_date', 'warranty_end_date', 'amc_start', 'amc_end', 'notes'], 'safe'],
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
        $query = Asset::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
		
		$dataProvider->sort = ['defaultOrder' => ['id' => 'DESC']];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category' => $this->category,
            'purchase_from' => $this->purchase_from,
            'purchase_date' => $this->purchase_date,
            'warranty_end_date' => $this->warranty_end_date,
            'amc_by' => $this->amc_by,
            'amc_start' => $this->amc_start,
            'amc_end' => $this->amc_end,
            'user_unit' => $this->user_unit,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
