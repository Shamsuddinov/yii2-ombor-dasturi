<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sold}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%product}}`
 */
class m210113_183449_create_sold_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sold}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date(),
            'quantity' => $this->decimal(20,3)->defaultValue(0),
            's_price' => $this->decimal(20,3),
            'seller_id' => $this->integer(),
            'product_id' => $this->integer(),
        ]);

        // creates index for column `seller_id`
        $this->createIndex(
            '{{%idx-sold-seller_id}}',
            '{{%sold}}',
            'seller_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-sold-seller_id}}',
            '{{%sold}}',
            'seller_id',
            '{{%users}}',
            'id'
//            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-sold-product_id}}',
            '{{%sold}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-sold-product_id}}',
            '{{%sold}}',
            'product_id',
            '{{%product}}',
            'id'
//            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-sold-seller_id}}',
            '{{%sold}}'
        );

        // drops index for column `seller_id`
        $this->dropIndex(
            '{{%idx-sold-seller_id}}',
            '{{%sold}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-sold-product_id}}',
            '{{%sold}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-sold-product_id}}',
            '{{%sold}}'
        );

        $this->dropTable('{{%sold}}');
    }
}
