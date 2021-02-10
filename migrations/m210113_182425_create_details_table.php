<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%details}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%contragent}}`
 */
class m210113_182425_create_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%details}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'contragent_id' => $this->integer(),
            'sum' => $this->decimal(20,3)->defaultValue(0),
        ]);

        // creates index for column `contragent_id`
        $this->createIndex(
            '{{%idx-details-contragent_id}}',
            '{{%details}}',
            'contragent_id'
        );

        // add foreign key for table `{{%contragent}}`
        $this->addForeignKey(
            '{{%fk-details-contragent_id}}',
            '{{%details}}',
            'contragent_id',
            '{{%contragent}}',
            'id'
//            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%contragent}}`
        $this->dropForeignKey(
            '{{%fk-details-contragent_id}}',
            '{{%details}}'
        );

        // drops index for column `contragent_id`
        $this->dropIndex(
            '{{%idx-details-contragent_id}}',
            '{{%details}}'
        );

        $this->dropTable('{{%details}}');
    }
}
