<?php

use yii\db\Migration;

/**
 * Class m200810_160849_AddColumnHeaderToFiles
 */
class m200810_160849_AddColumnHeaderToFiles extends Migration
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
        echo "m200810_160849_AddColumnHeaderToFiles cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('files', 'header', $this->string());
    }

    public function down()
    {
        $this->dropColumn('files', 'header');
    }
}
