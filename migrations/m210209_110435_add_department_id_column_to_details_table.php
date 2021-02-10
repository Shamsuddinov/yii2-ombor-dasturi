<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%details}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%department}}`
 */
class m210209_110435_add_department_id_column_to_details_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%details}}', 'department_id', $this->integer());

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-details-department_id}}',
            '{{%details}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-details-department_id}}',
            '{{%details}}',
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
            '{{%fk-details-department_id}}',
            '{{%details}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-details-department_id}}',
            '{{%details}}'
        );

        $this->dropColumn('{{%details}}', 'department_id');
    }
}
