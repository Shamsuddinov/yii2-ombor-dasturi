<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%sold}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%department}}`
 */
class m210217_111442_add_deparment_id_column_to_sold_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%sold}}', 'department_id', $this->integer());

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-sold-department_id}}',
            '{{%sold}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-sold-department_id}}',
            '{{%sold}}',
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
        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-sold-department_id}}',
            '{{%sold}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-sold-department_id}}',
            '{{%sold}}'
        );

        $this->dropColumn('{{%sold}}', 'department_id');
    }
}
