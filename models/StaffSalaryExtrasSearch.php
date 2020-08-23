<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaffSalaryExtras;

/**
 * app\models\StaffSalaryExtrasSearch represents the model behind the search form about `app\models\StaffSalaryExtras`.
 */
 class StaffSalaryExtrasSearch extends StaffSalaryExtras
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_extra', 'id_staff', 'id_salary', 'id_location'], 'integer'],
            [['state', 'datetime', 'type', 'comment', 'approve', 'timestamp'], 'safe'],
            [['summ'], 'number'],
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
//    public function search($params)
//    {
//        $query = StaffSalaryExtras::find();
//
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//        ]);
//
//        $this->load($params);
//
//        if (!$this->validate()) {
//            // uncomment the following line if you do not want to return any records when validation fails
//            // $query->where('0=1');
//            return $dataProvider;
//        }
//
//        $query->andFilterWhere([
//            'id_extra' => $this->id_extra,
//            'id_staff' => $this->id_staff,
//            'id_salary' => $this->id_salary,
//            'id_location' => $this->id_location,
//            'datetime' => $this->datetime,
//            'summ' => $this->summ,
//            'timestamp' => $this->timestamp,
//        ]);
//
//        $query->andFilterWhere(['like', 'state', $this->state])
//            ->andFilterWhere(['like', 'type', $this->type])
//            ->andFilterWhere(['like', 'comment', $this->comment])
//            ->andFilterWhere(['like', 'approve', $this->approve]);
//
//        return $dataProvider;
//    }
}
