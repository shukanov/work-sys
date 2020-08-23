<?php

use yii\db\Migration;

/**
 * Class m200806_162844_add_column_summ_to_staff_salary_table
 */
class m200806_162844_add_column_summ_to_staff_salary_table extends Migration
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
        echo "m200806_162844_add_column_summ_to_staff_salary_table cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('staff_salary', 'summ', $this->integer());

    }

    public function down()
    {
        $this->dropColumn('staff_salary', 'summ');
    }
}
