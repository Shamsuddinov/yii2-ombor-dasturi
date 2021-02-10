<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m210129_062406_add_status_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%product}}', 'created_by', $this->integer());
        $this->addColumn('{{%product}}', 'updated_by', $this->integer());
        $this->addColumn('{{%product}}', 'created_at', $this->integer());
        $this->addColumn('{{%product}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'status');
        $this->dropColumn('{{%product}}', 'created_by');
        $this->dropColumn('{{%product}}', 'updated_by');
        $this->dropColumn('{{%product}}', 'created_at');
        $this->dropColumn('{{%product}}', 'updated_at');
    }
}
