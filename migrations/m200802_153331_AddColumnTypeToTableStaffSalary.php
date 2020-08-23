<?php

use yii\db\Migration;

/**
 * Class m200802_153331_AddColumnTypeToTableStaffSalary
 */
class m200802_153331_AddColumnTypeToTableStaffSalary extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200802_153331_AddColumnTypeToTableStaffSalary cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('staff_salary', 'id_type', $this->integer());

        $this->createIndex(
            'idx-staff_salary-id_type',
            'staff_salary',
            'id_type'
        );

        $this->addForeignKey(
            'fk-staff_salary-staff_salary_type',
            'staff_salary',
            'id_type',
            'staff_salary_type',
            'id',
        );
    }

    public function down()
    {
        $this->dropColumn('staff_salary', 'id_type');

        $this->dropForeignKey(
            'fk-staff_salary-staff_salary_type',
            'staff_salary'
        );

        $this->dropIndex(
            'idx-staff_salary-id_type',
            'staff_salary'
        );

        return false;
    }
}
