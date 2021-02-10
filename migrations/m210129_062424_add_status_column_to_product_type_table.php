<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product_type}}`.
 */
class m210129_062424_add_status_column_to_product_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product_type}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%product_type}}', 'created_by', $this->integer());
        $this->addColumn('{{%product_type}}', 'updated_by', $this->integer());
        $this->addColumn('{{%product_type}}', 'created_at', $this->integer());
        $this->addColumn('{{%product_type}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product_type}}', 'status');
        $this->dropColumn('{{%product_type}}', 'created_by');
        $this->dropColumn('{{%product_type}}', 'updated_by');
        $this->dropColumn('{{%product_type}}', 'created_at');
        $this->dropColumn('{{%product_type}}', 'updated_at');
    }
}
