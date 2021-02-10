<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%contragent}}`.
 */
class m210129_062151_add_status_column_to_contragent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%contragent}}', 'status', $this->tinyInteger());
        $this->addColumn('{{%contragent}}', 'created_by', $this->integer());
        $this->addColumn('{{%contragent}}', 'updated_by', $this->integer());
        $this->addColumn('{{%contragent}}', 'created_at', $this->integer());
        $this->addColumn('{{%contragent}}', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%contragent}}', 'status');
        $this->dropColumn('{{%contragent}}', 'created_by');
        $this->dropColumn('{{%contragent}}', 'updated_by');
        $this->dropColumn('{{%contragent}}', 'created_at');
        $this->dropColumn('{{%contragent}}', 'updated_at');
    }
}
