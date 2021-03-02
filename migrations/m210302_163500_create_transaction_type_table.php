<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction_type}}`.
 */
class m210302_163500_create_transaction_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'type' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transaction_type}}');
    }
}
