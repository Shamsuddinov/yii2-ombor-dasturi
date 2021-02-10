<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%received}}`.
 */
class m210129_053806_add_status_column_to_received_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%received}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%received}}', 'created_by', $this->integer());
        $this->addColumn('{{%received}}', 'updated_by', $this->integer());
        $this->addColumn('{{%received}}', 'created_at', $this->integer());
        $this->addColumn('{{%received}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%received}}', 'status');
        $this->dropColumn('{{%received}}', 'created_by');
        $this->dropColumn('{{%received}}', 'updated_by');
        $this->dropColumn('{{%received}}', 'created_at');
        $this->dropColumn('{{%received}}', 'updated_at');
    }
}
