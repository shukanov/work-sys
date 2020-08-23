<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "staff_permissions".
 *
 * @property int $id_permission
 * @property int|null $id_location
 * @property int|null $id_position
 * @property int|null $id_staff
 * @property bool|null $edit_salary
 * @property bool|null $show_salary
 * @property bool|null $use_checkin_confirm_code
 * @property bool|null $use_checkin_uniform
 * @property bool|null $show_in_salary
 * @property bool|null $show_debug
 * @property bool|null $staff_transfer
 * @property bool|null $confirm_salary
 * @property string|null $comment
 */
class StaffPermissions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_permissions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_location', 'id_position', 'id_staff'], 'integer'],
            [['edit_salary', 'show_salary', 'use_checkin_confirm_code', 'use_checkin_uniform', 'show_in_salary', 'show_debug', 'staff_transfer', 'confirm_salary'], 'boolean'],
            [['comment'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_permission' => 'Id Permission',
            'id_location' => 'Id Location',
            'id_position' => 'Id Position',
            'id_staff' => 'Id Staff',
            'edit_salary' => 'Edit Salary',
            'show_salary' => 'Show Salary',
            'use_checkin_confirm_code' => 'Use Checkin Confirm Code',
            'use_checkin_uniform' => 'Use Checkin Uniform',
            'show_in_salary' => 'Show In Salary',
            'show_debug' => 'Show Debug',
            'staff_transfer' => 'Staff Transfer',
            'confirm_salary' => 'Confirm Salary',
            'comment' => 'Comment',
        ];
    }

    public function getPermissions()
    {
        return StaffPermissions::findOne(['id_staff' => $this->getId()]);
    }

}
