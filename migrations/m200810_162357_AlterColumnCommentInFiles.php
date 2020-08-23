<?php

use yii\db\Migration;

/**
 * Class m200810_162357_AlterColumnCommentInFiles
 */
class m200810_162357_AlterColumnCommentInFiles extends Migration
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
        echo "m200810_162357_AlterColumnCommentInFiles cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('files', 'comment', $this->string());
    }

    public function down()
    {
        echo "m200810_162357_AlterColumnCommentInFiles cannot be reverted.\n";

        return false;
    }
}
