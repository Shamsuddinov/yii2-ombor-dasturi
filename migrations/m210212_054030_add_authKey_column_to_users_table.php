<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%users}}`.
 */
class m210212_054030_add_authKey_column_to_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users}}', 'authKey', $this->string(32));
        $this->addColumn('{{%users}}', 'accessToken', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users}}', 'authKey');
        $this->dropColumn('{{%users}}', 'accessToken');
    }
}
