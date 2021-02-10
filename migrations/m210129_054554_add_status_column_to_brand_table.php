<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%brand}}`.
 */
class m210129_054554_add_status_column_to_brand_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%brand}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%brand}}', 'created_by', $this->integer());
        $this->addColumn('{{%brand}}', 'updated_by', $this->integer());
        $this->addColumn('{{%brand}}', 'created_at', $this->integer());
        $this->addColumn('{{%brand}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%brand}}', 'status');
        $this->dropColumn('{{%brand}}', 'created_by');
        $this->dropColumn('{{%brand}}', 'updated_by');
        $this->dropColumn('{{%brand}}', 'created_at');
        $this->dropColumn('{{%brand}}', 'updated_at');
    }
}
