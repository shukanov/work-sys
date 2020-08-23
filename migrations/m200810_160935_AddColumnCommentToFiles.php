<?php

use yii\db\Migration;

/**
 * Class m200810_160935_AddColumnCommentToFiles
 */
class m200810_160935_AddColumnCommentToFiles extends Migration
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
        echo "m200810_160935_AddColumnCommentToFiles cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('files', 'comment', $this->text());
    }

    public function down()
    {
        $this->dropColumn('files', 'comment');
    }
}
