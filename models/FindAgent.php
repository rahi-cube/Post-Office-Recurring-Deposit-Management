<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agents;

/**
 * FindAgent represents the model behind the search form about `app\models\Agents`.
 */
class FindAgent extends Agents
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'authority_no', 'validity_date', 'date_registered', 'field1', 'filed2', 'filed3'], 'safe'],
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
        $query = Agents::find();

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
            'validity_date' => $this->validity_date,
            'date_registered' => $this->date_registered,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'authority_no', $this->authority_no])
            ->andFilterWhere(['like', 'field1', $this->field1])
            ->andFilterWhere(['like', 'filed2', $this->filed2])
            ->andFilterWhere(['like', 'filed3', $this->filed3]);

        return $dataProvider;
    }
}
