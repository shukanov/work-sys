<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\helpers\VarDumper;

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
class Salary extends \yii\db\ActiveRecord
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
            'state' => 'Город',
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
            'late' => 'опоздания',
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
/*
    public function afterFind() {
        parent::afterFind ();
        $this->time_job_start = 0;
    }*/

    public function search($getQueryParams)
    {
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
            -> where('
                time_job_start IS NOT NULL OR
                time_job_end IS NOT NULL OR
                time_job_start_official IS NOT NULL OR
                time_job_end_official IS NOT NULL
            ')
            // ------------------------------------------------ДОБАВИЛ УСЛОВИЕ
            -> andWhere('
                time_job_start_approve != 1 OR
                time_job_end_approve != 1 OR
                position_approve != 1
            ')

            // -> andWhere(['or',
            //     ['<>', 1, 'time_job_start_approve'],
            //     ['<>', 1, 'time_job_end_approve'],
            //     ['<>', 1, 'position_approve']
            // ])
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

        // if (isset($getQueryParams['StaffSalary']['id_staff'])) {
        //     $query = $query-> andWhere('
        //         staff_salary.id_staff = "'.$getQueryParams['StaffSalary']['id_staff'].'"
        //     ');
        // }

        // if (isset($getQueryParams['id_staff'])) {
        //     $query = $query->andWhere(['staff_salary.id_staff'=>$getQueryParams['id_staff']]);
        // }

        // if (isset($getQueryParams['id_location'])) {
        //     $query = $query->andWhere(['staff_salary.id_location'=>$getQueryParams['id_location']]);
        // }


        //$query = $query->orderBy('staff_salary.time_job_start DESC, staff_salary.time_job_start_official DESC');
        //$query = $query->orderBy('GREATEST({{time_job_start}}, IFNULL({{time_job_start_official}},0) ) DESC');
        $query = $query->orderBy([new \yii\db\Expression("GREATEST(IFNULL({{time_job_start}},1), IFNULL({{time_job_start_official}},1)) DESC")]);

        if (isset($getQueryParams['last_name'])) {

            $query2 = Staff::find()->indexBy('id_staff')
                ->select('id_staff')
                ->where(['last_name' => $getQueryParams['last_name']])
                ->asArray()->all();
            $keys = array_keys($query2);

           $query = $query->andWhere(['staff_salary.id_staff'=>$keys]);


//        echo '<pre>';
//        VarDumper::dump($query);
//        echo '</pre>';

        }

//        VarDumper::dump($getQueryParams);
//
//        $model = $query->load($getQueryParams);


        $dataProvider = new ActiveDataProvider([
          //  'allModels' => $data,
            'query' => $query,
            'sort' => [
//                'defaultOrder' => [
//                    //'staff_salary.id_location' => SORT_DESC,
//                    'time_job_start_official' => SORT_DESC,
//                    'time_job_start' => SORT_DESC,
//                ]
            ],
        ]);

        return $dataProvider;
    }

<<<<<<< Updated upstream
    public static function calculateSalary($salaries) {
        $summ = 0;

=======
    public static function calculateSalary($id_staff, $dateStart='', $dateEnd='')
    {
        $summ = 0;

        $dateStart = '2020-07-01' . ' ' . '00:00:00';
        $dateEnd = '2020-12-31' . ' ' . '23:59:59';

        $salaries = StaffSalary::find()
            ->where([
                'id_staff' => $id_staff,
            ])
            ->andWhere([
                '>=', 'time_job_end', $dateStart
            ])
            ->andWhere([
                '<=', 'time_job_end', $dateEnd
            ])
            ->all();

>>>>>>> Stashed changes
        $query = ['or'];

        foreach ($salaries as $salary) {
            $query[] = ['id_salary' => $salary->id_salary];
        }

        $extras = StaffSalaryExtras::find()
            ->select('id_salary', 'summ')
            ->where($query)
            ->andWhere([
                '!=', 'summ', 0
            ])
            ->all();

        foreach ($salaries as $salary) {
            if (!empty($salary->rate)) {
                $summ += Salary::calculateSalaryByRate($salary);
            } elseif (!empty($salary->salary)) {
                $summ += $salary->salary;
            }

            foreach($extras as $extra) {
                if ($extra->id_salary == $salary->id_salary) {
                    $summ += $extra->summ;
                }
            }
        }

<<<<<<< Updated upstream
        return $summ;
=======
        return round($summ, 2);
>>>>>>> Stashed changes
    }

    protected static function calculateSalaryByRate($salary) {
        $hours = ((strtotime($salary->time_job_end) - strtotime($salary->time_job_start)) / 60) / 60;

        $summ = $hours * $salary->rate;

        return $summ;
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
<<<<<<< Updated upstream
=======

    public static function num2word($n,$words) {
        return ($words[($n=($n=$n%100)>19?($n%10):$n)==1?0 : (($n>1&&$n<=4)?1:2)]);
    }

    //--------------------------------------------------------
// Функция для преобразования числа в сумму прописью
//--------------------------------------------------------
// Автор: ManHunter / PCL (www.manhunter.ru)
//--------------------------------------------------------
    public static function sum2words($n) {
        $words=array(
            900=>'девятьсот',
            800=>'восемьсот',
            700=>'семьсот',
            600=>'шестьсот',
            500=>'пятьсот',
            400=>'четыреста',
            300=>'триста',
            200=>'двести',
            100=>'сто',
            90=>'девяносто',
            80=>'восемьдесят',
            70=>'семьдесят',
            60=>'шестьдесят',
            50=>'пятьдесят',
            40=>'сорок',
            30=>'тридцать',
            20=>'двадцать',
            19=>'девятнадцать',
            18=>'восемнадцать',
            17=>'семнадцать',
            16=>'шестнадцать',
            15=>'пятнадцать',
            14=>'четырнадцать',
            13=>'тринадцать',
            12=>'двенадцать',
            11=>'одиннадцать',
            10=>'десять',
            9=>'девять',
            8=>'восемь',
            7=>'семь',
            6=>'шесть',
            5=>'пять',
            4=>'четыре',
            3=>'три',
            2=>'два',
            1=>'один',
        );

        $level=array(
            4=>array('миллиард', 'миллиарда', 'миллиардов'),
            3=>array('миллион', 'миллиона', 'миллионов'),
            2=>array('тысяча', 'тысячи', 'тысяч'),
        );

        list($rub,$kop)=explode('.',number_format($n,2));
        $parts=explode(',',$rub);

        for($str='', $l=count($parts), $i=0; $i<count($parts); $i++, $l--) {
            if (intval($num=$parts[$i])) {
                foreach($words as $key=>$value) {
                    if ($num>=$key) {
                        // Fix для одной тысячи
                        if ($l==2 && $key==1) {
                            $value='одна';
                        }
                        // Fix для двух тысяч
                        if ($l==2 && $key==2) {
                            $value='две';
                        }

                        $str.=($str!=''?' ':'').$value;
                        $num-=$key;
                    }
                }
                if (isset($level[$l])) {
                    $str.=' '.Salary::num2word($parts[$i],$level[$l]);
                }
            }
        }

        if (intval($rub=str_replace(',','',$rub))) {
            $str.=' '.'руб.';
        }

        $parts=explode(',',$kop);

        for($str2='', $l=count($parts), $i=0; $i<count($parts); $i++, $l--) {
            if (intval($num=$parts[$i])) {
                foreach($words as $key=>$value) {
                    if ($num>=$key) {
                        // Fix для одной тысячи
                        if ($value == 'один') {
                            $value='одна';
                        }
                        // Fix для двух тысяч
                        if ($value == 'два') {
                            $value='две';
                        }

                        $str2.=($str!=''?' ':'').$value;
                        $num-=$key;
                    }
                }
            }
        }
        $str.=($str!=''?' ':'').$str2;
        $str.='коп.';

        return mb_substr($str,0,1,'utf-8').
            mb_substr($str,1,mb_strlen($str,'utf-8'),'utf-8');
    }

    public static function getDateWord()
    {
        $day = date('d');
        $month = date('m');
        $year = date('Y');

        if ($month == 1) {
            $month = 'Январь';
        } elseif ($month == 2) {
            $month = 'Февраля';
        } elseif ($month == 3) {
            $month = 'Марта';
        } elseif ($month == 4) {
            $month = 'Апреля';
        } elseif ($month == 5) {
            $month = 'Мая';
        } elseif ($month == 6) {
            $month = 'Июня';
        } elseif ($month == 7) {
            $month = 'Июля';
        } elseif ($month == 8) {
            $month = 'Августа';
        } elseif ($month == 9) {
            $month = 'Сентября';
        } elseif ($month == 10) {
            $month = 'Октября';
        } elseif ($month == 11) {
            $month = 'Ноября';
        } elseif ($month == 12) {
            $month = 'Декабря';
        }

        return $day . ' ' . $month . ' ' . $year;
    }
>>>>>>> Stashed changes
}
