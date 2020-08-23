<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "staff_salary_extras".
 *
 * @property int $id_extra
 * @property int|null $id_staff
 * @property int|null $id_salary
 * @property int|null $id_location
 * @property string|null $state
 * @property string|null $datetime
 * @property string|null $type
 * @property string|null $comment
 * @property float|null $summ
 * @property int $approve
 * @property string $timestamp
 */
class StaffSalaryExtras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_salary_extras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_staff', 'id_salary', 'id_location', 'approve'], 'integer'],
            [['datetime', 'timestamp'], 'safe'],
            [['summ'], 'number'],
            ['summ', 'default', 'value' => 0],
            [['state'], 'string', 'max' => 40],
            [['type'], 'string', 'max' => 50],
            [['comment'], 'string', 'max' => 255],
            [['id_location', 'id_salary', 'id_staff', 'datetime', 'type', 'comment'], 'unique', 'targetAttribute' => ['id_location', 'id_salary', 'id_staff', 'datetime', 'type', 'comment', 'summ']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_extra' => 'Идентификатор доп. информации к смене',
            'id_staff' => 'ID сотрудника',
            'id_salary' => 'ID смены',
            'id_location' => 'ID местоположения',
            'state' => 'Состояние',
            'datetime' => 'Дата, время',
            'type' => 'Тип',
            'comment' => 'Комментарий',
            'summ' => 'Сумма',
            'approve' => 'Подтверждение',
            'timestamp' => 'Дата, время создания',
        ];
    }

    public static function search($id_salary)
    {
        $query = StaffSalaryExtras::find()
            -> where([
                    'id_salary' => $id_salary
                ]
            );

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'datetime' => SORT_ASC,
                ]
            ],
        ]);

        return $dataProvider;
    }

    public static function searchSmallPagination($id_salary)
    {
        $query = StaffSalaryExtras::find()
            -> where([
                    'id_salary' => $id_salary
                ]
            );

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'datetime' => SORT_ASC,
                ]
            ],
            'pagination' => [
                'pageSize' => 14,
            ],
        ]);

        return $dataProvider;
    }

    public static function addLog($id_salary, $comment, $type='edit')
    {
        $model = new StaffSalaryExtras;

        $log = [
            'StaffSalaryExtras' => [
                'id_salary' => $id_salary,
                'id_staff' => Yii::$app->user->identity->id_staff,
                'datetime' => date('Y-m-d H:i:s'),
                'comment' => Yii::$app->user->identity->last_name . ' '. Yii::$app->user->identity->first_name . ' ' . $comment,
                'type' => $type,
            ]
        ];

        if ($model->load($log)) {
            // can save model or do something before saving model
            return $model->save();
        }

        return false;
    }
}
