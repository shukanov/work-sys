<?php

use yii\db\Migration;

/**
 * Class m200805_154633_add_column_is_deleted_to_staff_salary_table
 */
class m200805_154633_add_column_is_deleted_to_staff_salary_table extends Migration
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
        echo "m200805_154633_add_column_is_deleted_to_staff_salary_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('staff_salary', 'is_deleted', $this->boolean()->defaultValue(0));


    }

    public function down()
    {
        $this->dropColumn('staff_salary', 'is_deleted');

    }
}
