<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transaction}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%department}}`
 * - `{{%invoice}}`
 * - `{{%details}}`
 * - `{{%transaction_type}}`
 */
class m210302_174118_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transaction}}', [
            'id' => $this->primaryKey(),
            'department_id' => $this->integer()->notNull(),
            'invoice_id' => $this->integer(),
            'details_id' => $this->integer(),
            'sum' => $this->integer()->notNull(),
            'inventory' => $this->bigInteger()->notNull(),
            'type_id' => $this->integer(),
            'transaction_date' => $this->dateTime(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-transaction-department_id}}',
            '{{%transaction}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-transaction-department_id}}',
            '{{%transaction}}',
            'department_id',
            '{{%department}}',
            'id',
//            'CASCADE'
        );

        // creates index for column `invoice_id`
        $this->createIndex(
            '{{%idx-transaction-invoice_id}}',
            '{{%transaction}}',
            'invoice_id'
        );

        // add foreign key for table `{{%invoice}}`
        $this->addForeignKey(
            '{{%fk-transaction-invoice_id}}',
            '{{%transaction}}',
            'invoice_id',
            '{{%invoice}}',
            'id',
//            'CASCADE'
        );

        // creates index for column `details_id`
        $this->createIndex(
            '{{%idx-transaction-details_id}}',
            '{{%transaction}}',
            'details_id'
        );

        // add foreign key for table `{{%details}}`
        $this->addForeignKey(
            '{{%fk-transaction-details_id}}',
            '{{%transaction}}',
            'details_id',
            '{{%details}}',
            'id',
//            'CASCADE'
        );

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-transaction-type_id}}',
            '{{%transaction}}',
            'type_id'
        );

        // add foreign key for table `{{%transaction_type}}`
        $this->addForeignKey(
            '{{%fk-transaction-type_id}}',
            '{{%transaction}}',
            'type_id',
            '{{%transaction_type}}',
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
            '{{%fk-transaction-department_id}}',
            '{{%transaction}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-transaction-department_id}}',
            '{{%transaction}}'
        );

        // drops foreign key for table `{{%invoice}}`
        $this->dropForeignKey(
            '{{%fk-transaction-invoice_id}}',
            '{{%transaction}}'
        );

        // drops index for column `invoice_id`
        $this->dropIndex(
            '{{%idx-transaction-invoice_id}}',
            '{{%transaction}}'
        );

        // drops foreign key for table `{{%details}}`
        $this->dropForeignKey(
            '{{%fk-transaction-details_id}}',
            '{{%transaction}}'
        );

        // drops index for column `details_id`
        $this->dropIndex(
            '{{%idx-transaction-details_id}}',
            '{{%transaction}}'
        );

        // drops foreign key for table `{{%transaction_type}}`
        $this->dropForeignKey(
            '{{%fk-transaction-type_id}}',
            '{{%transaction}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-transaction-type_id}}',
            '{{%transaction}}'
        );

        $this->dropTable('{{%transaction}}');
    }
}
