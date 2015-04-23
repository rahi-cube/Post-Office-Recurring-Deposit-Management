<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MisAccount;

/**
 * FindMisAccount represents the model behind the search form about `app\models\MisAccount`.
 */
class FindMisAccount extends MisAccount
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account', 'contact_1', 'contact_2', 'contact_3', 'cheque_no', 'term', 'status'], 'integer'],
            [['kyc', 'payment_type', 'date_taken', 'register_date', 'start_date', 'end_date', 'field1', 'field2'], 'safe'],
            [['amount'], 'number'],
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
        $query = MisAccount::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'account' => $this->account,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'contact_3' => $this->contact_3,
            'amount' => $this->amount,
            'cheque_no' => $this->cheque_no,
            'date_taken' => $this->date_taken,
            'register_date' => $this->register_date,
            'term' => $this->term,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'kyc', $this->kyc])
            ->andFilterWhere(['like', 'payment_type', $this->payment_type])
            ->andFilterWhere(['like', 'field1', $this->field1])
            ->andFilterWhere(['like', 'field2', $this->field2]);

        return $dataProvider;
    }
}
