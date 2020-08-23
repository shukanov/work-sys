<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_salary_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property StaffSalary[] $staffSalaries
 */
class StaffSalaryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_salary_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[StaffSalaries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaffSalaries()
    {
        return $this->hasMany(StaffSalary::className(), ['id_type' => 'id']);
    }
}
