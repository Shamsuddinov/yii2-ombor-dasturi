<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%measurement}}`.
 */
class m210223_040405_create_measurement_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%measurement}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(25)->notNull()->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%measurement}}');
    }
}
