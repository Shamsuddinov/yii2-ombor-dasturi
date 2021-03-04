<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_control}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%department}}`
 */
class m210303_080643_create_user_control_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_control}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'department_id' => $this->integer(),
            'status' => $this->tinyInteger(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_control-user_id}}',
            '{{%user_control}}',
            'user_id'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-user_control-user_id}}',
            '{{%user_control}}',
            'user_id',
            '{{%users}}',
            'id',
//            'CASCADE'
        );

        // creates index for column `department_id`
        $this->createIndex(
            '{{%idx-user_control-department_id}}',
            '{{%user_control}}',
            'department_id'
        );

        // add foreign key for table `{{%department}}`
        $this->addForeignKey(
            '{{%fk-user_control-department_id}}',
            '{{%user_control}}',
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
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-user_control-user_id}}',
            '{{%user_control}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_control-user_id}}',
            '{{%user_control}}'
        );

        // drops foreign key for table `{{%department}}`
        $this->dropForeignKey(
            '{{%fk-user_control-department_id}}',
            '{{%user_control}}'
        );

        // drops index for column `department_id`
        $this->dropIndex(
            '{{%idx-user_control-department_id}}',
            '{{%user_control}}'
        );

        $this->dropTable('{{%user_control}}');
    }
}
