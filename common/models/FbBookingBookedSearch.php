<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FbBookingBooked;

/**
 * FbBookingBookedSearch represents the model behind the search form about `common\models\FbBookingBooked`.
 */
class FbBookingBookedSearch extends FbBookingBooked
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'facility_id', 'payment_method_id', 'payment_status', 'returned_by', 'cancelled_by', 'cancelled_reason', 'lasttime_book', 'peak', 'created_by', 'status'], 'integer'],
            [['slot_from', 'slot_to', 'payment_details', 'returned_date', 'returned_details', 'cancelled_time', 'lapse_date', 'notes', 'created'], 'safe'],
            [['price', 'deposit', 'total_amount', 'paid_amount', 'returned_amount'], 'number'],
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
        $query = FbBookingBooked::find();

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
            'user_id' => $this->user_id,
            'facility_id' => $this->facility_id, 
            'slot_to' => $this->slot_to,
            'price' => $this->price,
            'deposit' => $this->deposit,
            'total_amount' => $this->total_amount,
            'paid_amount' => $this->paid_amount,
            'payment_method_id' => $this->payment_method_id,
            'payment_status' => $this->payment_status,
            'returned_amount' => $this->returned_amount,
            'returned_by' => $this->returned_by,
            'returned_date' => $this->returned_date,
            'cancelled_time' => $this->cancelled_time,
            'cancelled_by' => $this->cancelled_by,
            'cancelled_reason' => $this->cancelled_reason,
            'lapse_date' => $this->lapse_date,
            'lasttime_book' => $this->lasttime_book,
            'peak' => $this->peak,
            'created' => $this->created,
            'created_by' => $this->created_by,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'payment_details', $this->payment_details])
            ->andFilterWhere(['like', 'returned_details', $this->returned_details])
            ->andFilterWhere(['like', 'notes', $this->notes]);


            if( $this->slot_from){   
                $this->slot_to = date('Y-m-d', strtotime("+1 day", strtotime($this->slot_from)));
                $query->andFilterWhere(['between', 'slot_from', $this->slot_from, $this->slot_to  ]);
            
           }
 
        return $dataProvider;
    }
}
