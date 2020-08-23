<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StaffSalary;

/**
 * app\models\StaffSalarySearch represents the model behind the search form about `app\models\StaffSalary`.
 */
 class StaffSalarySearch extends StaffSalary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_salary', 'id_staff', 'id_location', 'id_position', 'checkin_code', 'time_job_start_approve', 'time_job_end_approve', 'position_approve', 'late', 'delay', 'id_type'], 'integer'],
            [['state', 'time_job_start_command', 'time_job_comment', 'time_job_zone', 'time_job_start_wish', 'time_job_end_wish', 'time_job_start_official', 'time_job_end_official', 'time_job_start', 'time_job_end_command', 'time_job_end', 'position', 'comment', 'code'], 'safe'],
            [['rate'], 'number'],
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
        $query = StaffSalary::find();

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
            'id_salary' => $this->id_salary,
            'id_staff' => $this->id_staff,
            'id_location' => $this->id_location,
            'id_position' => $this->id_position,
            'time_job_start_command' => $this->time_job_start_command,
            'checkin_code' => $this->checkin_code,
            'time_job_start_wish' => $this->time_job_start_wish,
            'time_job_end_wish' => $this->time_job_end_wish,
            'time_job_start_official' => $this->time_job_start_official,
            'time_job_end_official' => $this->time_job_end_official,
            'time_job_start' => $this->time_job_start,
            'time_job_start_approve' => $this->time_job_start_approve,
            'time_job_end_command' => $this->time_job_end_command,
            'time_job_end' => $this->time_job_end,
            'time_job_end_approve' => $this->time_job_end_approve,
            'position_approve' => $this->position_approve,
            'rate' => $this->rate,
            'late' => $this->late,
            'delay' => $this->delay,
            'id_type' => $this->id_type,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'time_job_comment', $this->time_job_comment])
            ->andFilterWhere(['like', 'time_job_zone', $this->time_job_zone])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

    public function searchNotApproved($params)
    {
        $query = StaffSalary::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['or',
            ['time_job_start_approve' => true],
            ['time_job_end_approve' => $this->time_job_end_approve],
            ['position_approve' => $this->position_approve],
        ]);

                $query->andFilterWhere([
            'id_salary' => $this->id_salary,
            'id_staff' => $this->id_staff,
            'id_location' => $this->id_location,
            'id_position' => $this->id_position,
            'time_job_start_command' => $this->time_job_start_command,
            'checkin_code' => $this->checkin_code,
            'time_job_start_wish' => $this->time_job_start_wish,
            'time_job_end_wish' => $this->time_job_end_wish,
            'time_job_start_official' => $this->time_job_start_official,
            'time_job_end_official' => $this->time_job_end_official,
            'time_job_start' => $this->time_job_start,
            'time_job_start_approve' => $this->time_job_start_approve,
            'time_job_end_command' => $this->time_job_end_command,
            'time_job_end' => $this->time_job_end,
            'time_job_end_approve' => $this->time_job_end_approve,
            'position_approve' => $this->position_approve,
            'rate' => $this->rate,
            'late' => $this->late,
            'delay' => $this->delay,
            'id_type' => $this->id_type,
        ]);

        $query->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'time_job_comment', $this->time_job_comment])
            ->andFilterWhere(['like', 'time_job_zone', $this->time_job_zone])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;

    }
}
