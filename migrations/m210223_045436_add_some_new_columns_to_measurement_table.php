<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%measurement}}`.
 */
class m210223_045436_add_some_new_columns_to_measurement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%measurement}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%measurement}}', 'created_by', $this->integer());
        $this->addColumn('{{%measurement}}', 'updated_by', $this->integer());
        $this->addColumn('{{%measurement}}', 'created_at', $this->integer());
        $this->addColumn('{{%measurement}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%measurement}}', 'status');
        $this->dropColumn('{{%measurement}}', 'created_by');
        $this->dropColumn('{{%measurement}}', 'updated_by');
        $this->dropColumn('{{%measurement}}', 'created_at');
        $this->dropColumn('{{%measurement}}', 'updated_at');
    }
}
