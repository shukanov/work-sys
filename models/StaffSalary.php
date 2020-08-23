<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\VarDumper;

use DateTime;
use DateInterval;

/**
 * This is the model class for table "staff_salary".
 *
 * @property int $id_salary
 * @property int $id_staff
 * @property int|null $id_location
 * @property int|null $id_position
 * @property string|null $state
 * @property string|null $time_job_start_command
 * @property string|null $time_job_comment
 * @property int|null $checkin_code
 * @property string|null $time_job_zone
 * @property string|null $time_job_start_wish
 * @property string|null $time_job_end_wish
 * @property string|null $time_job_start_official
 * @property string|null $time_job_end_official
 * @property string|null $time_job_start
 * @property int|null $time_job_start_approve
 * @property string|null $time_job_end_command
 * @property string|null $time_job_end
 * @property int|null $time_job_end_approve
 * @property string|null $position
 * @property int|null $position_approve
 * @property float|null $rate
 * @property int|null $late
 * @property int|null $delay
 * @property string|null $comment
 */
class StaffSalary extends \yii\db\ActiveRecord
{

    public $useSalary;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_salary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_staff'], 'required'],
            // [['salary', 'rate'], 'required'],
            [['salary','rate', 'summ'], 'default', 'value' => 0],
            [['id_staff', 'id_location', 'id_position', 'checkin_code', 'time_job_start_approve', 'time_job_end_approve', 'position_approve', 'late', 'delay', 'id_type', 'salary', 'summ'], 'integer'],
            [['time_job_start_command', 'time_job_start_wish', 'time_job_end_wish', 'time_job_start_official', 'time_job_end_official', 'time_job_start', 'time_job_end_command', 'time_job_end'], 'safe'],
            [['rate'], 'number'],
            [['state', 'time_job_zone', 'position'], 'string', 'max' => 50],
            [['time_job_comment', 'comment'], 'string', 'max' => 150],
            ['is_deleted', 'default', 'value' => 0],
            [['is_deleted', 'useSalary'], 'boolean'],
          //  [['id_staff', 'id_location', 'time_job_start_command'], 'unique', 'targetAttribute' => ['id_staff', 'id_location', 'time_job_start_command']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_salary' => 'ID Зарплаты',
            'id_staff' => 'ID Сотрудника',
            'id_location' => 'ID Локации',
            'id_position' => 'ID Позиции',
            'state' => 'Состояние',
            'time_job_start_command' => 'Команда запуска времени',
            'time_job_comment' => 'Комментарии о работе',
            'checkin_code' => 'Код регистрации',
            'time_job_zone' => 'Временная зона работы',
            'time_job_start_wish' => 'Время начала работы по желанию',
            'time_job_end_wish' => 'Время окончания работы по желанию',
            'time_job_start_official' => 'Официальное время начало работы',
            'time_job_end_official' => 'Официальное время окончания работы',
            'time_job_start' => 'Время начала работы',
            'time_job_start_approve' => 'Подтверждения времени старта смены',
            'time_job_end_command' => 'Команда окончания времени',
            'time_job_end' => 'Время окончания работы',
            'time_job_end_approve' => 'Подтверждения времени окончания смены',
            'position' => 'Позиция',
            'position_approve' => 'Утвержденная позиция',
            'rate' => 'Ставка',
            'late' => 'Опоздания',
            'delay' => 'Задержка',
            'comment' => 'Комментарии',
            'id_type' => 'ID Типа',
            'is_deleted' => 'Статус удаления',
            'salary' => 'Зарплата',
            'useSalary' => 'Использование сдельной оплаты',
            'summ' => 'Сумма',
            'code' => 'Код',
        ];
    }


    public function search($getQueryParams)
    {
        // echo print_r($getQueryParams, true);
        // exit();
        // $id_staff = $getQueryParams['StaffSalary']['id_staff'];
       // echo '<pre>';
        $start = "2020-03-01";
        $start = date("Y-m-d", strtotime("-2 month"));

        
        // $query = StaffSalary::find();
        
        $query = StaffSalary::find()->indexBy('id_salary')
            ->select('staff_salary.*, staff.*, locations.*')
            ->joinWith(['locations', 'staff'])

            -> where('
                time_job_start IS NOT NULL OR
                time_job_end IS NOT NULL OR
                time_job_start_official IS NOT NULL OR
                time_job_end_official IS NOT NULL
            ')


            -> andWhere('
                time_job_start >= "'.$start.'" OR
                time_job_start_official >= "'.$start.'" 
            ')
            -> andWhere('
                time_job_end_official <= NOW() OR
                time_job_end <= NOW()
            ')
            

            ->orWhere('
                (
                    time_job_start_approve IS NULL OR
                    time_job_end_approve IS NULL
                )
                AND
                (
                    time_job_start >= "'.$start.'" OR
                    time_job_start_official >= "'.$start.'" 
                )
                AND
                (
                    time_job_start <= date_add(CURDATE(), interval 24*60*60 - 1 second) OR
                    time_job_start_official <= date_add(CURDATE(), interval 24*60*60 - 1 second)
                )
                AND
                (
                    time_job_end IS NULL OR
                    time_job_end_official IS NULL
                )
            ');

            if (!empty($getQueryParams['StaffSalary']['id_salary'])) {
                $query = $query-> andWhere('
                        staff_salary.id_salary = "'.$getQueryParams['StaffSalary']['id_salary'].'"
                    ');
            }


            if (!empty($getQueryParams['StaffSalary']['id_staff'])) {
                $query = $query-> andWhere('
                    staff_salary.id_staff = "'.$getQueryParams['StaffSalary']['id_staff'].'"
                ');
            }

            // echo '<pre>';
            // echo print_r($query, true);
            // echo '</pre>';
            // exit();
            

            if (!empty($getQueryParams['StaffSalary']['id_location'])) {
                $query = $query-> andWhere('
                        staff_salary.id_location = "'.$getQueryParams['StaffSalary']['id_location'].'"
                    ');
            }

            if (!empty($getQueryParams['time_job_start_official'])) {
                $query = $query-> andWhere('
                    time_job_start_official >= "'.$getQueryParams['time_job_start_official'].'" 
                    ');
            }

            if (!empty($getQueryParams['time_job_end_official'])) {
                $query = $query-> andWhere('
                    time_job_end_official <= "'.$getQueryParams['time_job_end_official'].'" 
                    ');
            }

            if (!empty($getQueryParams['time_job_start'])) {

                $date = date_format(date_create($getQueryParams['time_job_start']), "Y-m-d H:i:s"); 

                $query = $query-> andWhere('
                    time_job_start >= "'.$date.'" 
                    ');
            }

            if (!empty($getQueryParams['time_job_end'])) {

                $date = date_format(date_create($getQueryParams['time_job_end']), "Y-m-d H:i:s"); 

                $query = $query-> andWhere('
                    time_job_end <= "'.$date.'" 
                    ');
            }


            if (!empty($getQueryParams['StaffSalary']['rate'])) {

                $query = $query-> andWhere('
                        staff_salary.rate = "'.$getQueryParams['StaffSalary']['rate'].'"
                    ');
            }

            if (!empty($getQueryParams['StaffSalary']['late'])) {

                $query = $query-> andWhere('
                        staff_salary.late = "'.$getQueryParams['StaffSalary']['late'].'"
                    ');
            }

            if (!empty($getQueryParams['StaffSalary']['delay'])) {

                $query = $query-> andWhere('
                        staff_salary.delay = "'.$getQueryParams['StaffSalary']['delay'].'"
                    ');
            }

            
            if (!empty($getQueryParams['StaffSalary']['time_job_start_approve'])) {

                $flag = ($getQueryParams['StaffSalary']['time_job_start_approve'] == 1) ? 0 : 1;

                $query = $query-> andWhere('
                        staff_salary.time_job_start_approve = "'.$flag.'"
                    ');
            }

            if (!empty($getQueryParams['StaffSalary']['time_job_end_approve'])) {

                $flag = ($getQueryParams['StaffSalary']['time_job_end_approve'] == 1) ? 0 : 1;

                $query = $query-> andWhere('
                        staff_salary.time_job_end_approve = "'.$flag.'"
                    ');
            }

            if (!empty($getQueryParams['StaffSalary']['position_approve'])) {

                $flag = ($getQueryParams['StaffSalary']['position_approve'] == 1) ? 0 : 1;

                $query = $query-> andWhere('
                        staff_salary.position_approve = "'.$flag.'"
                    ');
            }

            // echo '<pre>';
            // echo print_r($query, true);
            // echo '</pre>';
            // exit();


        $query = $query->orderBy('staff_salary.time_job_start DESC, staff_salary.time_job_start_official DESC');
        $query = $query->orderBy('GREATEST({{time_job_start}}, IFNULL({{time_job_start_official}},0) ) DESC');
        $query = $query->orderBy([new \yii\db\Expression("GREATEST(IFNULL({{time_job_start}},1), IFNULL({{time_job_start_official}},1)) DESC")]);



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [

            ],
        ]);

        $this->load($getQueryParams);

        if (!$this->validate()) {

            // echo print_r($this, true);
            // exit();
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function searchNotApproved($getQueryParams)
    {
        // echo print_r($getQueryParams, true);
        // exit();
        // echo '<pre>';
        $start = "2020-03-01";
        $start = date("Y-m-d", strtotime("-2 month"));

        $query = StaffSalary::find()->indexBy('id_salary')
            ->select('staff_salary.*, staff.*, locations.*')
            ->joinWith(['locations', 'staff'])
            /*->from('staff_salary')
           ->leftJoin('staff', '`staff`.`id_staff` = `staff_salary`.`id_staff`')
            */
            //->with('staff')
//            -> where([
//                    'staff_salary.id_staff' => $id_staff
//                ]
//            )
            // -> where('
            //     time_job_start IS NOT NULL OR
            //     time_job_end IS NOT NULL OR
            //     time_job_start_official IS NOT NULL OR
            //     time_job_end_official IS NOT NULL
            // ')
            // ------------------------------------------------ДОБАВИЛ УСЛОВИЕ
            -> where('
                time_job_start_approve IS NULL OR
                time_job_end_approve IS NULL OR
                position_approve IS NULL OR
                time_job_start_approve = 0 OR
                time_job_end_approve = 0 OR
                position_approve = 0
            ')

//             // -> andWhere(['or',
//             //     ['<>', 1, 'time_job_start_approve'],
//             //     ['<>', 1, 'time_job_end_approve'],
//             //     ['<>', 1, 'position_approve']
//             // ])
            -> andWhere('
                time_job_start >= "'.$start.'" OR
                time_job_start_official >= "'.$start.'" 
            ')
            -> andWhere('
                time_job_end_official <= NOW() OR
                time_job_end <= NOW()
            ')
//            -> andWhere('
//                time_job_start_approve IS NULL OR
//                time_job_end_approve IS NULL
//            ')
            -> orWhere('
                (
                    time_job_start_approve IS NULL OR
                    time_job_end_approve IS NULL
                )
                AND
                (
                    time_job_start >= "'.$start.'" OR
                    time_job_start_official >= "'.$start.'" 
                )
                AND
                (
                    time_job_start <= date_add(CURDATE(), interval 24*60*60 - 1 second) OR
                    time_job_start_official <= date_add(CURDATE(), interval 24*60*60 - 1 second)
                )
                AND
                (
                    time_job_end IS NULL OR
                    time_job_end_official IS NULL
                )
            ');

        if (!empty($getQueryParams['StaffSalary']['id_salary'])) {
            $query = $query-> andWhere('
                    staff_salary.id_salary = "'.$getQueryParams['StaffSalary']['id_salary'].'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['id_staff'])) {
            $query = $query->andWhere(['staff_salary.id_staff'=>$getQueryParams['StaffSalary']['id_staff']]);
        }

        if (!empty($getQueryParams['StaffSalary']['id_location'])) {
            $query = $query->andWhere(['staff_salary.id_location'=>$getQueryParams['StaffSalary']['id_location']]);
        }

        if (!empty($getQueryParams['StaffSalary']['rate'])) {
            $query = $query-> andWhere('
                    staff_salary.rate = "'.$getQueryParams['StaffSalary']['rate'].'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['late'])) {
            $query = $query-> andWhere('
                    staff_salary.late = "'.$getQueryParams['StaffSalary']['late'].'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['delay'])) {
            $query = $query-> andWhere('
                    staff_salary.delay = "'.$getQueryParams['StaffSalary']['delay'].'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['time_job_start_approve'])) {

            $flag = ($getQueryParams['StaffSalary']['time_job_start_approve'] == 1) ? 0 : 1;

            $query = $query-> andWhere('
                    staff_salary.time_job_start_approve = "'.$flag.'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['time_job_end_approve'])) {

            $flag = ($getQueryParams['StaffSalary']['time_job_end_approve'] == 1) ? 0 : 1;

            $query = $query-> andWhere('
                    staff_salary.time_job_end_approve = "'.$flag.'"
                ');
        }

        if (!empty($getQueryParams['StaffSalary']['position_approve'])) {

            $flag = ($getQueryParams['StaffSalary']['position_approve'] == 1) ? 0 : 1;

            $query = $query-> andWhere('
                    staff_salary.position_approve = "'.$flag.'"
                ');
        }

        // --------------------<datetime>--------------
        if (!empty($getQueryParams['time_job_start_official'])) {
            $query = $query-> andWhere('
                time_job_start_official >= "'.$getQueryParams['time_job_start_official'].'" 
                ');
        }

        if (!empty($getQueryParams['time_job_end_official'])) {
            $query = $query-> andWhere('
                time_job_end_official <= "'.$getQueryParams['time_job_end_official'].'" 
                ');
        }

        if (!empty($getQueryParams['time_job_start'])) {

            $date = date_format(date_create($getQueryParams['time_job_start']), "Y-m-d H:i:s"); 

            $query = $query-> andWhere('
                time_job_start >= "'.$date.'" 
                ');
        }

        if (!empty($getQueryParams['time_job_end'])) {

            $date = date_format(date_create($getQueryParams['time_job_end']), "Y-m-d H:i:s"); 

            $query = $query-> andWhere('
                time_job_end <= "'.$date.'" 
                ');
        }
        // --------------------</datetime>--------------

        // echo '<pre>';
        // echo print_r($query, true);
        // echo '</pre>';
        // exit();
       
        $query = $query->orderBy([new \yii\db\Expression("GREATEST(IFNULL({{time_job_start}},1), IFNULL({{time_job_start_official}},1)) DESC")]);

        if (isset($getQueryParams['last_name'])) {

            $query2 = Staff::find()->indexBy('id_staff')
                ->select('id_staff')
                ->where(['last_name' => $getQueryParams['last_name']])
                ->asArray()->all();
            $keys = array_keys($query2);

            $query = $query->andWhere(['staff_salary.id_staff'=>$keys]);

        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [

            ],
        ]);

        return $dataProvider;
    }

    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id_staff' => 'id_staff']);
    }
    public function getLocations()
    {
        return $this->hasOne(Locations::className(), ['id_location' => 'id_location']);
    }
    public function getType()
    {
        return $this->hasOne(StaffSalaryType::className(), ['id' => 'id_type']);
    }

    public function getPosition()
    {
        return $this->hasOne(StaffPositions::className(), ['id_position' => 'id_position']);
    }

    public static function getMapFullName()
    {
        $staffSalaryIdFullNamePairs = [];
        $staffSalaryList = StaffSalary::find()->all();

        foreach ($staffSalaryList as $staffSalary) {
            $name = '';

            if (!empty($staffSalary->staff->last_name)) {
                $name .= $staffSalary->staff->last_name . ' ';
            }

            if (!empty($staffSalary->staff->first_name)) {
                $name .= $staffSalary->staff->first_name . ' ';
            }

            if (!empty($staffSalary->staff->second_name)) {
                $name .= $staffSalary->staff->second_name . ' ';
            }

            $name .= ' / ' . $staffSalary->state;

            if (!empty($staffSalary->position)) {
                $name .= ' / ' . $staffSalary->position;
            }

            if (!empty($staffSalary->locations)) {
                $name .= ' / ' . $staffSalary->locations->location;
            }

            $staffSalaryIdFullNamePairs[$staffSalary->id_salary] = $name;
        }

        return $staffSalaryIdFullNamePairs;
    }
}
