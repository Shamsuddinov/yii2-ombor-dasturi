<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contragent}}`.
 */
class m210113_181712_create_contragent_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contragent}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contragent}}');
    }
}
