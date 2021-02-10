<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sold}}`.
 */
class m210129_062442_add_status_column_to_sold_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sold}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%sold}}', 'created_by', $this->integer());
        $this->addColumn('{{%sold}}', 'updated_by', $this->integer());
        $this->addColumn('{{%sold}}', 'created_at', $this->integer());
        $this->addColumn('{{%sold}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%sold}}', 'status');
        $this->dropColumn('{{%sold}}', 'created_by');
        $this->dropColumn('{{%sold}}', 'updated_by');
        $this->dropColumn('{{%sold}}', 'created_at');
        $this->dropColumn('{{%sold}}', 'updated_at');
    }
}
