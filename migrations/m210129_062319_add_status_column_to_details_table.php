<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%details}}`.
 */
class m210129_062319_add_status_column_to_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%details}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%details}}', 'created_by', $this->integer());
        $this->addColumn('{{%details}}', 'updated_by', $this->integer());
        $this->addColumn('{{%details}}', 'created_at', $this->integer());
        $this->addColumn('{{%details}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%details}}', 'status');
        $this->dropColumn('{{%details}}', 'created_by');
        $this->dropColumn('{{%details}}', 'updated_by');
        $this->dropColumn('{{%details}}', 'created_at');
        $this->dropColumn('{{%details}}', 'updated_at');
    }
}
