<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%product_type}}`
 * - `{{%brand}}`
 */
class m210113_181024_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(40)->notNull(),
            'type_id' => $this->integer(),
            'brand_id' => $this->integer(),
            'quantity' => $this->decimal(20,3)->defaultValue(0),
            'properties' => $this->text(),
            'r_price' => $this->decimal(20,3)->defaultValue(0),
        ]);

        // creates index for column `type_id`
        $this->createIndex(
            '{{%idx-product-type_id}}',
            '{{%product}}',
            'type_id'
        );

        // add foreign key for table `{{%product_type}}`
        $this->addForeignKey(
            '{{%fk-product-type_id}}',
            '{{%product}}',
            'type_id',
            '{{%product_type}}',
            'id'
//            'CASCADE'
        );

        // creates index for column `brand_id`
        $this->createIndex(
            '{{%idx-product-brand_id}}',
            '{{%product}}',
            'brand_id'
        );

        // add foreign key for table `{{%brand}}`
        $this->addForeignKey(
            '{{%fk-product-brand_id}}',
            '{{%product}}',
            'brand_id',
            '{{%brand}}',
            'id'
//            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%product_type}}`
        $this->dropForeignKey(
            '{{%fk-product-type_id}}',
            '{{%product}}'
        );

        // drops index for column `type_id`
        $this->dropIndex(
            '{{%idx-product-type_id}}',
            '{{%product}}'
        );

        // drops foreign key for table `{{%brand}}`
        $this->dropForeignKey(
            '{{%fk-product-brand_id}}',
            '{{%product}}'
        );

        // drops index for column `brand_id`
        $this->dropIndex(
            '{{%idx-product-brand_id}}',
            '{{%product}}'
        );

        $this->dropTable('{{%product}}');
    }
}
