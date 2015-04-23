<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Schedule;

/**
 * FindSchedule represents the model behind the search form about `app\models\Schedule`.
 */
class FindSchedule extends Schedule
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'srno'], 'integer'],
            [['month', 'year', 'schedule_date', 'field1', 'field2', 'field3'], 'safe'],
            [['gross_total', 'commision', 'net_amount', 'tds'], 'number'],
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
        $query = Schedule::find();

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
            'id' => $this->id,
            'srno' => $this->srno,
            'month' => $this->month,
            'year' => $this->year,
            'schedule_date' => $this->schedule_date,
            'gross_total' => $this->gross_total,
            'commision' => $this->commision,
            'net_amount' => $this->net_amount,
            'tds' => $this->tds,
        ]);

        $query->andFilterWhere(['like', 'field1', $this->field1])
            ->andFilterWhere(['like', 'field2', $this->field2])
            ->andFilterWhere(['like', 'field3', $this->field3]);

        return $dataProvider;
    }
}
