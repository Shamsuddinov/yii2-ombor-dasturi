<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%department}}`.
 */
class m210202_115205_add_status_column_to_department_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%department}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%department}}', 'created_by', $this->integer());
        $this->addColumn('{{%department}}', 'created_at', $this->integer());
        $this->addColumn('{{%department}}', 'updated_by', $this->integer());
        $this->addColumn('{{%department}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%department}}', 'status');
        $this->dropColumn('{{%department}}', 'created_by');
        $this->dropColumn('{{%department}}', 'created_at');
        $this->dropColumn('{{%department}}', 'updated_by');
        $this->dropColumn('{{%department}}', 'updated_at');
    }
}
