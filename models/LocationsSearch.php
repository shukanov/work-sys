<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Locations;
use DateTime;
use DateInterval;
use yii\db\Expression;

/**
 * app\models\LocationsSearch represents the model behind the search form about `app\models\Locations`.
 */
 class LocationsSearch extends Locations
{
    /**
     * @inheritdoc 
     */
    public function rules()
    {
        return [
            [['id_location', 'chat_id', 'first_shift_min_for_late', 'second_shift_min_for_late', 'approve_min_for_delay', 'sort'], 'integer'],
            [['location', 'short_name', 'alternative_names', 'official_name', 'address', '2gis', 's_workweek_from', 's_workweek_to', 's_saturday_from', 's_saturday_to', 's_sunday_from', 's_sunday_to', 'last_online', 'photo'], 'safe'],
            [['show_in_reg', 'show_in_salary', 'pre_order', 'delivery'], 'boolean'],
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
        $query = Locations::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_location' => $this->id_location,
            'chat_id' => $this->chat_id,
            'first_shift_min_for_late' => $this->first_shift_min_for_late,
            'second_shift_min_for_late' => $this->second_shift_min_for_late,
            'approve_min_for_delay' => $this->approve_min_for_delay,
            'sort' => $this->sort,
            'show_in_reg' => $this->show_in_reg,
            'show_in_salary' => $this->show_in_salary,
            'last_online' => $this->last_online,
            'pre_order' => $this->pre_order,
            'delivery' => $this->delivery,
        ]);

        $query->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'alternative_names', $this->alternative_names])
            ->andFilterWhere(['like', 'official_name', $this->official_name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', '2gis', $this->__get('2gis')])
            ->andFilterWhere(['like', 'photo', $this->photo]);

        if (!empty($params['LocationsSearch']['id_location'])) {
            $query = $query->andFilterWhere(['id_location' => $params['LocationsSearch']['id_location']]);
        }

        if (!empty($params['LocationsSearch']['location'])) {
            $query = $query->andFilterWhere(['like', 'location', $params['LocationsSearch']['location']]);
        }

        if (!empty($params['LocationsSearch']['short_name'])) {
            $query = $query->andFilterWhere(['like', 'short_name', $params['LocationsSearch']['short_name']]);
        }

        if (!empty($params['LocationsSearch']['alternative_names'])) {
            $query = $query->andFilterWhere(['like', 'alternative_names', $params['LocationsSearch']['alternative_names']]);
        }

        if (!empty($params['LocationsSearch']['official_name'])) {
            $query = $query->andFilterWhere(['like', 'official_name', $params['LocationsSearch']['official_name']]);
        }

        if (!empty($params['LocationsSearch']['address'])) {
            $query = $query->andFilterWhere(['like', 'address', $params['LocationsSearch']['address']]);
        }

        if (!empty($params['LocationsSearch']['2gis'])) {
            $query = $query->andFilterWhere(['like', '2gis', $params['LocationsSearch']['2gis']]);
        }

        if (!empty($params['LocationsSearch']['first_shift_min_for_late'])) {
            $query = $query->andFilterWhere(['first_shift_min_for_late' => $params['LocationsSearch']['first_shift_min_for_late']]);
        }

        if (!empty($params['LocationsSearch']['second_shift_min_for_late'])) {
            $query = $query->andFilterWhere(['second_shift_min_for_late' => $params['LocationsSearch']['second_shift_min_for_late']]);
        }

        if (!empty($params['LocationsSearch']['approve_min_for_delay'])) {
            $query = $query->andFilterWhere(['approve_min_for_delay' => $params['LocationsSearch']['approve_min_for_delay']]);
        }

        // ----------------------<Время>------------
        if (!empty($params['LocationsSearch']['s_workweek_from'])) {
            $query = $query-> andWhere('
            s_workweek_from >= "'.$params['LocationsSearch']['s_workweek_from'].'"
            ');
        }

        if (!empty($params['LocationsSearch']['s_workweek_to'])) {
            $query = $query-> andWhere('
            s_workweek_to <= "'.$params['LocationsSearch']['s_workweek_to'].'"
            ');
        }

        if (!empty($params['LocationsSearch']['s_saturday_from'])) {
            $query = $query-> andWhere('
            s_saturday_from >= "'.$params['LocationsSearch']['s_saturday_from'].'"
            ');
        }

        if (!empty($params['LocationsSearch']['s_saturday_to'])) {
            $query = $query-> andWhere('
            s_saturday_to <= "'.$params['LocationsSearch']['s_saturday_to'].'"
            ');
        }

        if (!empty($params['LocationsSearch']['s_sunday_from'])) {
            $query = $query-> andWhere('
            s_sunday_from >= "'.$params['LocationsSearch']['s_sunday_from'].'"
            ');
        }

        if (!empty($params['LocationsSearch']['s_sunday_to'])) {
            $query = $query-> andWhere('
            s_sunday_to <= "'.$params['LocationsSearch']['s_sunday_to'].'"
            ');
        }

        if (!empty($params['last_online'])) {
            $query = $query-> andWhere('
            last_online <= "'.$params['last_online'].'"
            ');
        }

        // ------------------------------</Время>----------------

        if (!empty($params['LocationsSearch']['sort'])) {
            $query = $query->andFilterWhere(['sort' <= $params['LocationsSearch']['sort']]);
        }

        if (!empty($params['LocationsSearch']['photo'])) {
            $query = $query->andFilterWhere(['photo' <= $params['LocationsSearch']['photo']]);
        }

        // echo '<pre>';
        // echo print_r($query, true);
        // echo '</pre>';
        // exit();

        return $dataProvider;
    }
}
