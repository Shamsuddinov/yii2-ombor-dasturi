<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%received}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%product}}`
 * - `{{%details}}`
 */
class m210113_184602_create_received_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%received}}', [
            'id' => $this->primaryKey(),
            'receiver_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantity' => $this->decimal(20,3)->defaultValue(0),
            'r_price' => $this->decimal(20,3)->defaultValue(0),
            'details_id' => $this->integer(),
        ]);

        // creates index for column `receiver_id`
        $this->createIndex(
            '{{%idx-received-receiver_id}}',
            '{{%received}}',
            'receiver_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-received-receiver_id}}',
            '{{%received}}',
            'receiver_id',
            '{{%users}}',
            'id'
//            'CASCADE'
        );

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-received-product_id}}',
            '{{%received}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-received-product_id}}',
            '{{%received}}',
            'product_id',
            '{{%product}}',
            'id'
//            'CASCADE'
        );

        // creates index for column `details_id`
        $this->createIndex(
            '{{%idx-received-details_id}}',
            '{{%received}}',
            'details_id'
        );

        // add foreign key for table `{{%details}}`
        $this->addForeignKey(
            '{{%fk-received-details_id}}',
            '{{%received}}',
            'details_id',
            '{{%details}}',
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
            '{{%fk-received-receiver_id}}',
            '{{%received}}'
        );

        // drops index for column `receiver_id`
        $this->dropIndex(
            '{{%idx-received-receiver_id}}',
            '{{%received}}'
        );

        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-received-product_id}}',
            '{{%received}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-received-product_id}}',
            '{{%received}}'
        );

        // drops foreign key for table `{{%details}}`
        $this->dropForeignKey(
            '{{%fk-received-details_id}}',
            '{{%received}}'
        );

        // drops index for column `details_id`
        $this->dropIndex(
            '{{%idx-received-details_id}}',
            '{{%received}}'
        );

        $this->dropTable('{{%received}}');
    }
}
