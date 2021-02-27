<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%invoice}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%department}}`
 */
class m210227_045926_create_invoice_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%invoice}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer(),
            'sum' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-invoice-department_id}}',
            '{{%invoice}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-invoice-department_id}}',
            '{{%invoice}}',
            'department_id',
            '{{%department}}',
            'id',
//            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-invoice-department_id}}',
            '{{%invoice}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-invoice-department_id}}',
            '{{%invoice}}'
        );

        $this->dropTable('{{%invoice}}');
    }
}
