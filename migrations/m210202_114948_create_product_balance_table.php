<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_balance}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%department}}`
 */
class m210202_114948_create_product_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_balance}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(20,3)->defaultValue(0),
            'price' => $this->decimal(20,3)->defaultValue(0),
            'department_id' => $this->integer()->notNull(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_balance-product_id}}',
            '{{%product_balance}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_balance-product_id}}',
            '{{%product_balance}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-product_balance-department_id}}',
            '{{%product_balance}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-product_balance-department_id}}',
            '{{%product_balance}}',
            'department_id',
            '{{%department}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-product_balance-product_id}}',
            '{{%product_balance}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_balance-product_id}}',
            '{{%product_balance}}'
        );

        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-product_balance-department_id}}',
            '{{%product_balance}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-product_balance-department_id}}',
            '{{%product_balance}}'
        );

        $this->dropTable('{{%product_balance}}');
    }
}
