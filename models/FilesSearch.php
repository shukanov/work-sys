<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Files;
use DateTime;
use DateInterval;
use yii\db\Expression;

/**
 * app\models\FilesSearch represents the model behind the search form about `app\models\Files`.
 */
 class FilesSearch extends Files
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_location', 'id_staff', 'id_salary', 'i'], 'integer'],
            [['type', 'file', 'datetime'], 'safe'],
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
    public function search($getQueryParams)
    {
        $query = Files::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($getQueryParams);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_location' => $this->id_location,
            'id_staff' => $this->id_staff,
            'id_salary' => $this->id_salary,
            'i' => $this->i,
            'datetime' => $this->datetime,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'file', $this->file]);

        if (!empty($getQueryParams['FilesSearch']['id_location'])) {
            $query = $query->andFilterWhere(['id_location' => $getQueryParams['FilesSearch']['id_location']]);
        }

        if (!empty($getQueryParams['FilesSearch']['id_staff'])) {
            $query = $query->andFilterWhere(['id_staff' => $getQueryParams['FilesSearch']['id_staff']]);
        }

        if (!empty($getQueryParams['FilesSearch']['type'])) {
            $query = $query->andFilterWhere(['like', 'type', $getQueryParams['FilesSearch']['type']]);
        }

        if (!empty($getQueryParams['FilesSearch']['i'])) {
            $query = $query->andFilterWhere(['i' => $getQueryParams['FilesSearch']['i']]);
        }

        if (!empty($getQueryParams['FilesSearch']['comment'])) {
            $query = $query->andFilterWhere(['like', 'comment', $getQueryParams['FilesSearch']['comment']]);
        }

        if (!empty($getQueryParams['FilesSearch']['header'])) {
            $query = $query->andFilterWhere(['like', 'header', $getQueryParams['FilesSearch']['header']]);
        }

        if (!empty($getQueryParams['datetime'])) {

            $query = $query-> andWhere('
            datetime >= "'.$getQueryParams['datetime'].'"
            ');
        }

        if (!empty($getQueryParams['storage_life'])) {

            $date = date_format(date_create($getQueryParams['storage_life']), "Y-m-d"); 

            $query = $query-> andWhere('
                storage_life <= "'.$date.'"
            ');
        }


        // echo '<pre>';
        // echo print_r($query, true);
        // echo '</pre>';
        // exit();

        return $dataProvider;
    }

    public function searchStaff($params, $id)
    {
        $query = Files::find();

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
            'id_staff' => $id,
            // 'id_location' => $this->id_location,
            // 'id_staff' => $this->id_staff,
            // 'id_salary' => $this->id_salary,
            // 'i' => $this->i,
            // 'datetime' => $this->datetime,
        ]);

        // $query->andFilterWhere(['like', 'type', $this->type])
        //     ->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
