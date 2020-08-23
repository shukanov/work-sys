<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Staff;

/**
 * app\models\StaffSearch represents the model behind the search form about `app\models\Staff`.
 */
 class StaffSearch extends Staff
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_staff', 'id_telegram', 'id_location', 'id_position_official', 'passport_first_page', 'passport_second_page'], 'integer'],
            [['last_name', 'first_name', 'second_name', 'telegram_username', 'status', 'state', 'date_start', 'date_end', 'date_start_official', 'date_end_official', 'personnel_number', 'unique_excel_name', 'sex', 'phone', 'email', 'date_of_birth', 'vk', 'instagram', 'inn', 'snils', 'passport_number', 'passport_date', 'passport_authority', 'place_of_birth', 'address_home', 'address_register', 'length_of_service', 'family_members', 'family_status', 'uniform_size', 'comment', 'education', 'health_card', 'military_id', 'info'], 'safe'],
            [['date_start_approve', 'always_show'], 'boolean'],
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

        // echo print_r($params, true);
        // exit();
        // echo '<pre>';

        $query = Staff::find();

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
            'id_staff' => $this->id_staff,
            'id_telegram' => $this->id_telegram,
            'id_location' => $this->id_location,
            'date_start' => $this->date_start,
            'date_start_approve' => $this->date_start_approve,
            'date_end' => $this->date_end,
            'date_start_official' => $this->date_start_official,
            'date_end_official' => $this->date_end_official,
            'id_position_official' => $this->id_position_official,
            'date_of_birth' => $this->date_of_birth,
            'always_show' => $this->always_show,
            'passport_date' => $this->passport_date,
            'passport_first_page' => $this->passport_first_page,
            'passport_second_page' => $this->passport_second_page,
        ]);

        $query->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'second_name', $this->second_name])
            ->andFilterWhere(['like', 'telegram_username', $this->telegram_username])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'personnel_number', $this->personnel_number])
            ->andFilterWhere(['like', 'unique_excel_name', $this->unique_excel_name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'vk', $this->vk])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'snils', $this->snils])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'passport_authority', $this->passport_authority])
            ->andFilterWhere(['like', 'place_of_birth', $this->place_of_birth])
            ->andFilterWhere(['like', 'address_home', $this->address_home])
            ->andFilterWhere(['like', 'address_register', $this->address_register])
            ->andFilterWhere(['like', 'length_of_service', $this->length_of_service])
            ->andFilterWhere(['like', 'family_members', $this->family_members])
            ->andFilterWhere(['like', 'family_status', $this->family_status])
            ->andFilterWhere(['like', 'uniform_size', $this->uniform_size])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'health_card', $this->health_card])
            ->andFilterWhere(['like', 'military_id', $this->military_id])
            ->andFilterWhere(['like', 'info', $this->info]);

        if (!empty($params['StaffSearch']['id_staff'])) {
            $query = $query->andFilterWhere(['id_staff' => $params['StaffSearch']['id_staff']]);
        }

        if (!empty($params['StaffSearch']['first_name'])) {
            $query = $query->andFilterWhere(['like', 'first_name', $params['StaffSearch']['first_name']]);
        }

        if (!empty($params['StaffSearch']['second_name'])) {
            $query = $query->andFilterWhere(['like', 'second_name', $params['StaffSearch']['second_name']]);
        }

        if (!empty($params['StaffSearch']['id_telegram'])) {
            $query = $query->andFilterWhere(['id_telegram' => $params['StaffSearch']['id_telegram']]);
        }

        if (!empty($params['StaffSearch']['telegram_username'])) {
            $query = $query->andFilterWhere(['like', 'telegram_username', $params['StaffSearch']['telegram_username']]);
        }

        if (!empty($params['StaffSearch']['status'])) {
            $query = $query->andFilterWhere(['status' => $params['StaffSearch']['status']]);
        }

        if (!empty($params['StaffSearch']['state'])) {
            $query = $query->andFilterWhere(['like', 'state', $params['StaffSearch']['state']]);

        }

        if (!empty($params['StaffSearch']['personnel_number'])) {
            $query = $query->andFilterWhere(['like', 'personnel_number', $params['StaffSearch']['personnel_number']]);
        }

        if (!empty($params['StaffSearch']['unique_excel_name'])) {
            $query = $query->andFilterWhere(['like', 'unique_excel_name', $params['StaffSearch']['unique_excel_name']]);
        }

        if (!empty($params['StaffSearch']['sex'])) {
            $query = $query->andFilterWhere(['sex' => $params['StaffSearch']['sex']]);
        }

        if (!empty($params['StaffSearch']['phone'])) {
            $query = $query->andFilterWhere(['like', 'phone', $params['StaffSearch']['phone']]);
        }

        if (!empty($params['StaffSearch']['email'])) {
            $query = $query->andFilterWhere(['like', 'email', $params['StaffSearch']['email']]);
        }

        if (!empty($params['StaffSearch']['vk'])) {
            $query = $query->andFilterWhere(['like', 'vk', $params['StaffSearch']['vk']]);
        }

        if (!empty($params['StaffSearch']['instagram'])) {
            $query = $query->andFilterWhere(['like', 'instagram', $params['StaffSearch']['instagram']]);
        }

        if (!empty($params['StaffSearch']['inn'])) {
            $query = $query->andFilterWhere(['like', 'inn', $params['StaffSearch']['inn']]);
        }

        if (!empty($params['StaffSearch']['snils'])) {
            $query = $query->andFilterWhere(['like', 'snils', $params['StaffSearch']['snils']]);
        }

        if (!empty($params['StaffSearch']['passport_number'])) {
            $query = $query->andFilterWhere(['like', 'passport_number', $params['StaffSearch']['passport_number']]);
        }

        if (!empty($params['StaffSearch']['passport_authority'])) {
            $query = $query->andFilterWhere(['like', 'passport_authority', $params['StaffSearch']['passport_authority']]);
        }

        if (!empty($params['StaffSearch']['place_of_birth'])) {
            $query = $query->andFilterWhere(['like', 'place_of_birth', $params['StaffSearch']['place_of_birth']]);
        }

        if (!empty($params['StaffSearch']['passport_first_page'])) {
            $query = $query->andFilterWhere(['like', 'passport_first_page', $params['StaffSearch']['passport_first_page']]);
        }

        if (!empty($params['StaffSearch']['passport_second_page'])) {
            $query = $query->andFilterWhere(['like', 'passport_second_page', $params['StaffSearch']['passport_second_page']]);
        }

        if (!empty($params['StaffSearch']['address_home'])) {
            $query = $query->andFilterWhere(['like', 'address_home', $params['StaffSearch']['address_home']]);
        }

        if (!empty($params['StaffSearch']['address_register'])) {
            $query = $query->andFilterWhere(['like', 'address_register', $params['StaffSearch']['address_register']]);
        }

        if (!empty($params['StaffSearch']['family_members'])) {
            $query = $query->andFilterWhere(['like', 'family_members', $params['StaffSearch']['family_members']]);
        }

        if (!empty($params['StaffSearch']['family_status'])) {
            $query = $query->andFilterWhere(['like', 'family_status', $params['StaffSearch']['family_status']]);
        }

        if (!empty($params['StaffSearch']['comment'])) {
            $query = $query->andFilterWhere(['like', 'comment', $params['StaffSearch']['comment']]);
        }

        if (!empty($params['StaffSearch']['education'])) {
            $query = $query->andFilterWhere(['like', 'education', $params['StaffSearch']['education']]);
        }

        if (!empty($params['StaffSearch']['health_card'])) {
            $query = $query->andFilterWhere(['like', 'health_card', $params['StaffSearch']['health_card']]);
        }

        if (!empty($params['StaffSearch']['military_id'])) {
            $query = $query->andFilterWhere(['like', 'military_id', $params['StaffSearch']['military_id']]);
        }

        if (!empty($params['StaffSearch']['info'])) {
            $query = $query->andFilterWhere(['like', 'info', $params['StaffSearch']['info']]);
        }

        // -------------------------------------------------------<DATE>-------------------------

        // if (!empty($getQueryParams['StaffSearch']['date_start'])) {
        //     $query = $query->andFilterWhere(['date_start' => $getQueryParams['StaffSearch']['date_start']]);
        // }

        if (!empty($params['date_start'])) {

            $date = date_format(date_create($params['date_start']), "Y-m-d"); 

            // $query = $query-> andFilterWhere("staff.date_start >= :date_start", [
            //         'date_start' => $date,
            // ]);

            $query = $query-> andWhere('
                staff.date_start >= "'.$date.'"
                ');
        }

        if (!empty($params['date_end'])) {

            $date = date_format(date_create($params['date_end']), "Y-m-d"); 

            // $query = $query-> andFilterWhere([
            //         '<=', 'staff.date_end', $date,
            // ]);

            // $query = $query-> andFilterWhere("staff.date_end <= :date_end", [
            //     'date_end' => $date,
            // ]);

            $query = $query-> andWhere('
                staff.date_end <= "'.$date.'"
            ');
        }

        if (!empty($params['date_start_official'])) {

            $date = date_format(date_create($params['date_start_official']), "Y-m-d"); 

            $query = $query-> andWhere('
                staff.date_start_official >= "'.$date.'"
            ');
        }

        if (!empty($params['date_end_official'])) {

            $date = date_format(date_create($params['date_end_official']), "Y-m-d"); 

            $query = $query-> andWhere('
                staff.date_end_official <= "'.$date.'"
            ');
        }

        if (!empty($params['date_of_birth'])) {

            $date = date_format(date_create($params['date_of_birth']), "Y-m-d"); 

            $query = $query-> andWhere('
                staff.date_of_birth = "'.$date.'"
            ');
        }

        if (!empty($params['passport_date'])) {

            $date = date_format(date_create($params['passport_date']), "Y-m-d"); 

            $query = $query-> andWhere('
                staff.passport_date = "'.$date.'"
            ');
        }
        
        // -------------------------------------------------------</DATE>-------------------------
        


        // echo '<pre>';
        // echo print_r($query, true);
        // echo '</pre>';
        // exit();

        return $dataProvider;
    }
}
