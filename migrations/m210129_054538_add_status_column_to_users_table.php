<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m210129_054538_add_status_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%users}}', 'created_by', $this->integer());
        $this->addColumn('{{%users}}', 'updated_by', $this->integer());
        $this->addColumn('{{%users}}', 'created_at', $this->integer());
        $this->addColumn('{{%users}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'status');
        $this->dropColumn('{{%users}}', 'created_by');
        $this->dropColumn('{{%users}}', 'updated_by');
        $this->dropColumn('{{%users}}', 'created_at');
        $this->dropColumn('{{%users}}', 'updated_at');
    }
}
