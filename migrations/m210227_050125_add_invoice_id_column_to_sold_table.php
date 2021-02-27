<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sold}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%invoice}}`
 */
class m210227_050125_add_invoice_id_column_to_sold_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sold}}', 'invoice_id', $this->integer());

        // creates index for column `invoice_id`
        $this->createIndex(
            '{{%idx-sold-invoice_id}}',
            '{{%sold}}',
            'invoice_id'
        );

        // add foreign key for table `{{%invoice}}`
        $this->addForeignKey(
            '{{%fk-sold-invoice_id}}',
            '{{%sold}}',
            'invoice_id',
            '{{%invoice}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%invoice}}`
        $this->dropForeignKey(
            '{{%fk-sold-invoice_id}}',
            '{{%sold}}'
        );

        // drops index for column `invoice_id`
        $this->dropIndex(
            '{{%idx-sold-invoice_id}}',
            '{{%sold}}'
        );

        $this->dropColumn('{{%sold}}', 'invoice_id');
    }
}
