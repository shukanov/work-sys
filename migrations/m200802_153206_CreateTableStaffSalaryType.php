<?php

use yii\db\Migration;

/**
 * Class m200802_153206_CreateTableStaffSalaryType
 */
class m200802_153206_CreateTableStaffSalaryType extends Migration
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
        echo "m200802_153206_CreateTableStaffSalaryType cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('staff_salary_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('staff_salary_type');
    }
}
