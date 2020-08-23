<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_positions".
 *
 * @property int $id_position
 * @property string|null $position
 * @property int|null $default_rate
 * @property int|null $bonus_hours
 * @property int|null $bonus_rate
 * @property int|null $month_bonus
 * @property int|null $real_salary
 * @property bool|null $show_in_telegram
 * @property int|null $bonus_sales
 * @property int|null $sort
 * @property bool|null $edit_salary
 */
class StaffPositions extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_positions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['default_rate', 'bonus_hours', 'bonus_rate', 'month_bonus', 'real_salary', 'bonus_sales', 'sort'], 'integer'],
            [['show_in_telegram', 'edit_salary'], 'boolean'],
            [['position'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_position' => 'ID Позиции',
            'position' => 'Позиция',
            'default_rate' => 'Ставка по умолчанию',
            'bonus_hours' => 'Бонусные часы',
            'bonus_rate' => 'Бонусная ставка',
            'month_bonus' => 'Месячный бонус',
            'real_salary' => 'Реальная зарплата',
            'show_in_telegram' => 'Показать в Телеграм',
            'bonus_sales' => 'Бонусные продажи',
            'sort' => 'Сортировка',
            'edit_salary' => 'Изменить зарплату',
        ];
    }

    public function saveAll()
    {
    return parent::save();
    }

    public function loadAll($post)
    {
        return parent::load($post, '');
    }

    public  function  deleteWithRelated()
    {
        return parent::delete();
    }
}
