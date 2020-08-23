<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaffPositions;

/**
 * app\models\StaffPositionsSearch represents the model behind the search form about `app\models\StaffPositions`.
 */
 class StaffPositionsSearch extends StaffPositions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_position', 'default_rate', 'bonus_hours', 'bonus_rate', 'month_bonus', 'real_salary', 'bonus_sales', 'sort'], 'integer'],
            [['position'], 'safe'],
            [['show_in_telegram', 'edit_salary'], 'boolean'],
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
        $query = StaffPositions::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_position' => $this->id_position,
            'default_rate' => $this->default_rate,
            'bonus_hours' => $this->bonus_hours,
            'bonus_rate' => $this->bonus_rate,
            'month_bonus' => $this->month_bonus,
            'real_salary' => $this->real_salary,
            'show_in_telegram' => $this->show_in_telegram,
            'bonus_sales' => $this->bonus_sales,
            'sort' => $this->sort,
            'edit_salary' => $this->edit_salary,
        ]);

        $query->andFilterWhere(['like', 'position', $this->position]);

        if (!empty($getQueryParams['StaffPositionsSearch']['position'])) {
            $query = $query->andFilterWhere(['like', 'position', $getQueryParams['StaffPositionsSearch']['position']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['default_rate'])) {
            $query = $query->andFilterWhere(['default_rate' => $getQueryParams['StaffPositionsSearch']['default_rate']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['bonus_hours'])) {
            $query = $query->andFilterWhere(['bonus_hours' => $getQueryParams['StaffPositionsSearch']['bonus_hours']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['bonus_rate'])) {
            $query = $query->andFilterWhere(['bonus_rate' => $getQueryParams['StaffPositionsSearch']['bonus_rate']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['month_bonus'])) {
            $query = $query->andFilterWhere(['month_bonus' => $getQueryParams['StaffPositionsSearch']['month_bonus']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['real_salary'])) {
            $query = $query->andFilterWhere(['real_salary' => $getQueryParams['StaffPositionsSearch']['real_salary']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['bonus_sales'])) {
            $query = $query->andFilterWhere(['bonus_sales' => $getQueryParams['StaffPositionsSearch']['bonus_sales']]);
        }

        if (!empty($getQueryParams['StaffPositionsSearch']['sort'])) {
            $query = $query->andFilterWhere(['sort' => $getQueryParams['StaffPositionsSearch']['sort']]);
        }

        return $dataProvider;
    }
}
