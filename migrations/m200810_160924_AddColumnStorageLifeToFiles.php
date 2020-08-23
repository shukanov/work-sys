<?php

use yii\db\Migration;

/**
 * Class m200810_160924_AddColumnStorageLifeToFiles
 */
class m200810_160924_AddColumnStorageLifeToFiles extends Migration
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
        echo "m200810_160924_AddColumnStorageLifeToFiles cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('files', 'storage_life', $this->date()->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('files', 'storage_life');
    }
}
