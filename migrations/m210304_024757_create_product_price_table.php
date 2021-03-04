<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_price}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product}}`
 * - `{{%department}}`
 */
class m210304_024757_create_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_price}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'department_id' => $this->integer(),
            'type' => $this->tinyInteger(),
            'price' => $this->integer()->notNull(),
            'from_date' => $this->dateTime(),
            'to_date' => $this->dateTime(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            '{{%idx-product_price-product_id}}',
            '{{%product_price}}',
            'product_id'
        );

        // add foreign key for table `{{%product}}`
        $this->addForeignKey(
            '{{%fk-product_price-product_id}}',
            '{{%product_price}}',
            'product_id',
            '{{%product}}',
            'id',
//            'CASCADE'
        );

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-product_price-department_id}}',
            '{{%product_price}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-product_price-department_id}}',
            '{{%product_price}}',
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
        // drops foreign key for table `{{%product}}`
        $this->dropForeignKey(
            '{{%fk-product_price-product_id}}',
            '{{%product_price}}'
        );

        // drops index for column `product_id`
        $this->dropIndex(
            '{{%idx-product_price-product_id}}',
            '{{%product_price}}'
        );

        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-product_price-department_id}}',
            '{{%product_price}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-product_price-department_id}}',
            '{{%product_price}}'
        );

        $this->dropTable('{{%product_price}}');
    }
}
