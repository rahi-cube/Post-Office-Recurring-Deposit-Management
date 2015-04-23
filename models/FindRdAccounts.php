<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RdAccounts;

/**
 * FindRdAccounts represents the model behind the search form about `app\models\RdAccounts`.
 */
class FindRdAccounts extends RdAccounts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['account_no', 'contact_1', 'contact_2', 'deposit_amount', 'term', 'card_no', 'balance_in', 'balance_out'], 'integer'],
            [['kyc', 'start_date', 'end_date', 'half_withdrawal', 'last_trans_date', 'date_registered', 'field1', 'field2', 'filed3', 'filed4', 'filed5'], 'safe'],
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
        $query = RdAccounts::find();

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
            'account_no' => $this->account_no,
            'contact_1' => $this->contact_1,
            'contact_2' => $this->contact_2,
            'deposit_amount' => $this->deposit_amount,
            'term' => $this->term,
            'card_no' => $this->card_no,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'balance_in' => $this->balance_in,
            'balance_out' => $this->balance_out,
            'last_trans_date' => $this->last_trans_date,
            'date_registered' => $this->date_registered,
        ]);

        $query->andFilterWhere(['like', 'kyc', $this->kyc])
            ->andFilterWhere(['like', 'half_withdrawal', $this->half_withdrawal])
            ->andFilterWhere(['like', 'field1', $this->field1])
            ->andFilterWhere(['like', 'field2', $this->field2])
            ->andFilterWhere(['like', 'filed3', $this->filed3])
            ->andFilterWhere(['like', 'filed4', $this->filed4])
            ->andFilterWhere(['like', 'filed5', $this->filed5]);

        return $dataProvider;
    }
}
