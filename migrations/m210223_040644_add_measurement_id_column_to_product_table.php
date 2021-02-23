<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%measurement}}`
 */
class m210223_040644_add_measurement_id_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'measurement_id', $this->integer());

        // creates index for column `measurement_id`
        $this->createIndex(
            '{{%idx-product-measurement_id}}',
            '{{%product}}',
            'measurement_id'
        );

        // add foreign key for table `{{%measurement}}`
        $this->addForeignKey(
            '{{%fk-product-measurement_id}}',
            '{{%product}}',
            'measurement_id',
            '{{%measurement}}',
            'id',
//            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%measurement}}`
        $this->dropForeignKey(
            '{{%fk-product-measurement_id}}',
            '{{%product}}'
        );

        // drops index for column `measurement_id`
        $this->dropIndex(
            '{{%idx-product-measurement_id}}',
            '{{%product}}'
        );

        $this->dropColumn('{{%product}}', 'measurement_id');
    }
}
